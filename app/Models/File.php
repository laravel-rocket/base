<?php
namespace App\Models;

use LaravelRocket\Foundation\Models\Base;

class File extends Base
{
    const FILE_TYPE_FILE  = 'file';
    const FILE_TYPE_IMAGE = 'image';

    const STORAGE_TYPE_S3    = 's3';
    const STORAGE_TYPE_LOCAL = 'local';
    const STORAGE_TYPE_URL   = 'url';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'title',
        'entity_type',
        'entity_id',
        'storage_type',
        'file_type',
        'file_category_type',
        's3_key',
        's3_bucket',
        's3_region',
        's3_extension',
        'media_type',
        'format',
        'original_file_name',
        'file_size',
        'width',
        'height',
        'is_enabled',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [];

    protected $casts    = [
        'thumbnails' => 'array',
    ];

    protected $presenter = \App\Presenters\FilePresenter::class;

    // Relations

    // Utility Functions

    /**
     * @return string
     */
    public function getUrl()
    {
        if (config('app.offline_mode', false)) {
            return \URLHelper::asset('img/local.png', 'common');
        }

        return !empty($this->url) ? $this->url : 'https://placehold.jp/1440x900.jpg';
    }

    /**
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    public function getThumbnailUrl($width, $height)
    {
        if (config('app.offline_mode', false)) {
            return $this->getUrl();
        }

        $defaultThumbnailUrl = $this->thumbnail_url;
        if (empty($defaultThumbnailUrl)) {
            $defaultThumbnailUrl = $this->getUrl();
        }

        if (empty($this->url)) {
            if ($height == 0) {
                $height = intval($width / 4 * 3);
            }

            return 'https://placehold.jp/'.$width.'x'.$height.'.jpg';
        }

        $categoryType = $this->file_category_type;
        $confList     = config('file.categories');

        $conf = array_get($confList, $categoryType);

        if (empty($conf)) {
            return $defaultThumbnailUrl;
        }

        if (array_get($conf, 'type') !== 'image') {
            return $defaultThumbnailUrl;
        }

        $size = array_get($conf, 'size');
        if ($width === $size[0] && $height === $size[1]) {
            return $defaultThumbnailUrl;
        }

        $thumbnails = $this->thumbnails;
        if (!is_array($thumbnails)) {
            $thumbnails = [];
        }

        if (preg_match(' /^(.+?)\.([^\.]+)$/', $this->url, $match)) {
            $base = $match[1];
            $ext  = $match[2];

            foreach ($thumbnails as $thumbnail) {
                if ($width === $thumbnail[0] && $height === $thumbnail[1]) {
                    return $base.'_'.$thumbnail[0].'_'.$thumbnail[1].'.'.$ext;
                }
                if ($thumbnail[1] == 0 && $height == 0 && $width <= $thumbnail[0]) {
                    return $base.'_'.$thumbnail[0].'_'.$thumbnail[1].'.'.$ext;
                }
                if ($thumbnail[1] == 0 && $height != 0 && $size[1] != 0) {
                    if (floor($width / $height * 1000) === floor($size[0] / $size[1] * 1000) && $width <= $thumbnail[0]) {
                        return $base.'_'.$thumbnail[0].'_'.$thumbnail[1].'.'.$ext;
                    }
                }
                if ($thumbnail[1] > 0 && $height > 0) {
                    if (floor($width / $height * 1000) === floor($thumbnail[0] / $thumbnail[1] * 1000) && $width <= $thumbnail[0]) {
                        return $base.'_'.$thumbnail[0].'_'.$thumbnail[1].'.'.$ext;
                    }
                }
            }
        }

        return $defaultThumbnailUrl;
    }
}
