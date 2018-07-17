<?php
namespace App\Services\Production;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use App\Services\FileServiceInterface;
use LaravelRocket\Foundation\Services\FileUploadLocalServiceInterface;
use LaravelRocket\Foundation\Services\FileUploadS3ServiceInterface;
use LaravelRocket\Foundation\Services\FileUploadServiceInterface;
use LaravelRocket\Foundation\Services\ImageServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;

class FileService extends BaseService implements FileServiceInterface
{
    /** @var \App\Repositories\FileRepositoryInterface */
    protected $fileRepository;

    /** @var ImageServiceInterface */
    protected $imageService;

    /** @var FileUploadServiceInterface[] */
    protected $fileUploadServices;

    public function __construct(
        FileRepositoryInterface $fileRepository,
        ImageServiceInterface $imageService,
        FileUploadLocalServiceInterface $fileUploadLocalService,
        FileUploadS3ServiceInterface $fileUploadS3Service
    ) {
        $this->fileRepository     = $fileRepository;
        $this->imageService       = $imageService;
        $this->fileUploadServices = [
            'local' => $fileUploadLocalService,
            's3'    => $fileUploadS3Service,
            'url'   => null,
            'null'  => null,
        ];
    }

    public function uploadFromText($categoryType, $text, $mediaType, $metaInputs)
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'upload');
        $handle   = fopen($tempFile, 'w');
        fwrite($handle, $text);
        fclose($handle);

        $file = $this->upload($categoryType, $tempFile, $mediaType, $metaInputs);

        unlink($handle);

        return $file;
    }

    public function upload($categoryType, $path, $mediaType, $metaInputs)
    {
        $conf = config('file.categories.'.$categoryType);
        if (empty($conf)) {
            return null;
        }

        // Support Android Retrofit Bad Data Format
        $checkData = @file_get_contents($path);
        if (starts_with($checkData, 'Content-Length:')) {
            $pos = strpos($checkData, "\r\n\r\n");
            if ($pos !== false) {
                \Log::info('Detect Wrong Data');
                $checkData = substr($checkData, $pos + 4);
                $path      = $path.'.removed';
                file_put_contents($path, $checkData);
                $mediaType = mime_content_type($path);
            }
        }

        $acceptableFileList = config('file.acceptable.'.$conf['type']);
        if (!array_key_exists($mediaType, $acceptableFileList)) {
            return null;
        }
        $ext = array_get($acceptableFileList, $mediaType);

        $storageConfig = $this->getStorageConfig($categoryType);
        $storageType   = array_get($storageConfig, 'type');

        $model     = null;
        $modelData = [
            'url'                => $path,
            'storage_type'       => $storageType,
            'title'              => array_get($metaInputs, 'title', ''),
            'file_type'          => File::FILE_TYPE_IMAGE,
            'file_category_type' => $categoryType,
            'entity_type'        => array_get($metaInputs, 'entityType', ''),
            'entity_id'          => array_get($metaInputs, 'entityId', 0),
            's3_key'             => '',
            's3_bucket'          => '',
            's3_region'          => '',
            's3_extension'       => $ext,
            'media_type'         => $mediaType,
            'format'             => $mediaType,
            'file_size'          => 0,
            'original_filename'  => array_get($metaInputs, 'originalFileName', ''),
            'width'              => 0,
            'height'             => 0,
            'is_enabled'         => true,
        ];
        $dstPath = $path;
        if ($conf['type'] == 'image') {
            $dstPath = $path.'.converted';
            $format  = array_get($conf, 'format', 'jpeg');
            $size    = $this->imageService->convert($path, $dstPath, $format, array_get($conf, 'size'));
            if (!file_exists($dstPath)) {
                return null;
            }
            $modelData['width']  = array_get($size, 'width', 0);
            $modelData['height'] = array_get($size, 'height', 0);
        }
        $modelData['file_size'] = filesize($path);

        $seed = array_get($conf, 'seed_prefix', '').time().rand();
        $key  = $this->generateFileName($seed, null, $ext);

        $fileUploadServices = array_get($this->fileUploadServices, $storageType);
        if (!empty($fileUploadServices)) {
            $result = $fileUploadServices->upload($dstPath, $mediaType, $key, $conf);

            if (!array_get($result, 'success', false)) {
                return null;
            }

            $modelData['url']           = array_get($result, 'url', 0);
            $modelData['s3_bucket']     = array_get($result, 's3_bucket', array_get($result, 'bucket', ''));
            $modelData['s3_region']     = array_get($result, 's3_region', array_get($result, 'region', ''));
            $modelData['s3_key']        = array_get($result, 's3_key', array_get($result, 'key', ''));
            $modelData['thumbnails']    = [];

            if ($conf['type'] == File::FILE_TYPE_IMAGE) {
                $format = array_get($conf, 'format', 'jpeg');
                foreach (array_get($conf, 'thumbnails', []) as $thumbnail) {
                    $this->imageService->convert($path, $dstPath, $format, $thumbnail, true);
                    $thumbnailKey = $this->getThumbnailKeyFromKey($key, $thumbnail);
                    $result       = $fileUploadServices->upload($dstPath, $mediaType, $thumbnailKey, $conf);

                    if (array_get($result, 'success', false)) {
                        $modelData['thumbnails'][] = $thumbnail;
                    }
                }
            }
        }

        $model = $this->fileRepository->create($modelData);

        return $model;
    }

    public function delete($model)
    {
        $storageType = $model->storageType;
        $key         = $model->s3_key;

        if (empty($key)) {
            return true;
        }

        $fileUploadService = array_get($this->fileUploadServices, $storageType);
        if (!empty($fileUploadService)) {
            $fileUploadService->delete([
                's3_key' => $key,
            ]);
        }

        $this->fileRepository->delete($model);

        return true;
    }

    public function createFromUrl($categoryType, $url, $mediaType, $metaInputs)
    {
        $conf = config('file.categories.'.$categoryType);
        if (empty($conf)) {
            return null;
        }

        $modelData = [
            'url'                => $url,
            'storage_type'       => File::STORAGE_TYPE_URL,
            'title'              => array_get($metaInputs, 'title', ''),
            'file_type'          => array_get($conf, 'type', File::FILE_TYPE_FILE),
            'file_category_type' => $categoryType,
            'entity_type'        => array_get($metaInputs, 'entityType', ''),
            'entity_id'          => array_get($metaInputs, 'entityId', 0),
            's3_key'             => '',
            's3_bucket'          => '',
            's3_region'          => '',
            's3_extension'       => '',
            'media_type'         => $mediaType,
            'format'             => $mediaType,
            'file_size'          => 0,
            'original_filename'  => array_get($metaInputs, 'originalFileName', ''),
            'width'              => 0,
            'height'             => 0,
            'is_enabled'         => true,
        ];
        $model = $this->fileRepository->create($modelData);

        return $model;
    }

    protected function getStorageConfig($categoryType)
    {
        $storageType = config('file.storage.default');

        $config = $this->getCategoryConfig($categoryType);
        if (!empty($config)) {
            $storageType = array_get($config, 'storage', $storageType);
        }
        $storageConfig = config('file.storage.'.$storageType);
        if (empty($storageConfig)) {
            $storageConfig = config('file.storage.'.config('file.storage.default'));
        }
        if (empty($storageConfig)) {
            $storageConfig = config('file.storage.local');
        }

        return $storageConfig;
    }

    protected function getCategoryConfig($categoryType)
    {
        $config = config('file.categories.'.$categoryType);
        if (empty($config)) {
            $config = config('file.categories.default-file');
        }

        return $config;
    }

    /**
     * @param string      $seed
     * @param string|null $postFix
     * @param string|null $ext
     *
     * @return string
     */
    protected function generateFileName($seed, $postFix, $ext)
    {
        $filename = md5($seed);
        if (!empty($postFix)) {
            $filename .= '_'.$postFix;
        }
        if (!empty($ext)) {
            $filename .= '.'.$ext;
        }

        return $filename;
    }

    /**
     * @param string $key
     * @param array  $size
     *
     * @return null|string
     */
    protected function getThumbnailKeyFromKey($key, $size)
    {
        if (preg_match('/^(.+?)\.([^\.]+)$/', $key, $match)) {
            return $match[1].'_'.$size[0].'_'.$size[1].'.'.$match[2];
        }

        return null;
    }

    protected function getDominantColor($filePath)
    {
    }
}
