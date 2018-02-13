<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelRocket\Foundation\Models\Base;

/**
 * App\Models\File.
 *
 * @method \App\Presenters\FilePresenter present()
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
