<?php
namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 * @property  \App\Models\File $entity
 * @property  int $id
 * @property  string $url
 * @property  string $title
 * @property  string $entity_type
 * @property  int $entity_id
 * @property  string $storage_type
 * @property  string $file_category_type
 * @property  string $file_type
 * @property  string $s3_key
 * @property  string $s3_bucket
 * @property  string $s3_region
 * @property  string $s3_extension
 * @property  string $media_type
 * @property  string $format
 * @property  string $original_file_name
 * @property  int $file_size
 * @property  int $width
 * @property  int $height
 * @property  string $thumbnails
 * @property  bool $is_enabled
 * @property  \Carbon\Carbon $deleted_at
 * @property  \Carbon\Carbon $created_at
 * @property  \Carbon\Carbon $updated_at
 */
class FilePresenter extends BasePresenter
{
    protected $multilingualFields = [
    ];

    protected $imageFields = [
    ];

    public function entity_type()
    {
        return trans('tables/files/columns.entity_type_options.'.$this->entity->entity_type);
    }

    public function storage_type()
    {
        return trans('tables/files/columns.storage_type_options.'.$this->entity->storage_type);
    }

    public function file_category_type()
    {
        return trans('tables/files/columns.file_category_type_options.'.$this->entity->file_category_type);
    }

    public function file_type()
    {
        return trans('tables/files/columns.file_type_options.'.$this->entity->file_type);
    }

    public function media_type()
    {
        return trans('tables/files/columns.media_type_options.'.$this->entity->media_type);
    }
}
