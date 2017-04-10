<?php
namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class FileRepository extends SingleKeyModelRepository implements FileRepositoryInterface
{
    public function getBlankModel()
    {
        return new File();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
