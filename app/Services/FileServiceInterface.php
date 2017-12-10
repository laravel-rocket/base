<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface FileServiceInterface extends BaseServiceInterface
{
    /**
     * @param string $categoryType
     * @param string $text
     * @param string $mediaType
     * @param array  $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function uploadFromText($categoryType, $text, $mediaType, $metaInputs);

    /**
     * @param int    $categoryType
     * @param string $path
     * @param string $mediaType
     * @param array  $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function upload($categoryType, $path, $mediaType, $metaInputs);

    /**
     * @param \App\Models\File $model
     *
     * @return bool|null
     */
    public function delete($model);

    /**
     * @param string $categoryType
     * @param string $url
     * @param string $mediaType
     * @param array  $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function createFromUrl($categoryType, $url, $mediaType, $metaInputs);
}
