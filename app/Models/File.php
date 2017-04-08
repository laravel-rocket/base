<?php

namespace App\Models;

use LaravelRocket\Foundation\Models\Base;

class File extends Base
{

    const FILE_TYPE_FILE = 'file';
    const FILE_TYPE_IMAGE = 'image';

    const STORAGE_TYPE_S3 = 's3';

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
    protected $hidden    = [];

    protected $dates     = [];

    protected $presenter = \App\Presenters\FilePresenter::class;

    // Relations

    // Utility Functions

}
