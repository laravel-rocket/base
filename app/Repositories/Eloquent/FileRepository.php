<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\FileRepositoryInterface;
use App\Models\File;

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
