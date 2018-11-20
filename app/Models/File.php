<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelRocket\Foundation\Models\Base;

/**
 * App\Models\File.
 *
 * @method \App\Presenters\FilePresenter present()
 *
 * @property int $id
 * @property string $url
 * @property string|null $title
 * @property string $entity_type
 * @property int $entity_id
 * @property string $storage_type
 * @property string $file_category_type
 * @property string $s3_key
 * @property string $s3_bucket
 * @property string $s3_region
 * @property string $s3_extension
 * @property string $media_type
 * @property string $format
 * @property string $original_file_name
 * @property int $file_size
 * @property int $width
 * @property int $height
 * @property string|null $thumbnails
 * @property int $is_enabled
 * @property string|null $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $profileImages
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFileCategoryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMediaType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOriginalFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereS3Bucket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereS3Extension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereS3Key($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereS3Region($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereStorageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereThumbnails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File withoutTrashed()
 * @mixin \Eloquent
 */
class File extends Base
{
    use SoftDeletes;

    const FILE_TYPE_FILE            = 'file';
    const FILE_TYPE_IMAGE           = 'image';
    const FILE_TYPE_IMAGE_VIDEO     = 'video';
    const STORAGE_TYPE_LOCAL        = 'local';
    const STORAGE_TYPE_S3           = 's3';
    const STORAGE_TYPE_S3_LOCAL     = 'local';
    const STORAGE_TYPE_S3_LOCAL_URL = 'url';
    const STORAGE_TYPE_URL          = 'url';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'files';

    protected $casts  = [
        'is_enabled' => 'boolean',
        'thumbnails' => 'array',
    ];
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
        'file_category_type',
        'file_type',
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
        'thumbnails',
        'is_enabled',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [
    ];

    protected $presenter = \App\Presenters\FilePresenter::class;

    // Relations
    public function profileImages()
    {
        return $this->hasMany(\App\Models\User::class, 'profile_image_id', 'id');
    }

    // Utility Functions
}
