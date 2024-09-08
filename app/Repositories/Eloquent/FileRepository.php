<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Arr;
use LaravelRocket\Foundation\Models\Base;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class FileRepository extends SingleKeyModelRepository implements FileRepositoryInterface
{
    public function getBlankModel(): \LaravelRocket\Foundation\Models\Base
    {
        return new File;
    }

    public function rules(): array
    {
        return [
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }

    protected function buildQueryByFilter(\Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|Base $query, array $filter): \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder|Base
    {
        if (array_key_exists('query', $filter)) {
            $searchWord = Arr::get($filter, 'query');
            if (! empty($searchWord)) {
                $query = $query->where(function ($q) use ($searchWord) {
                    $q->where('original_file_name', 'LIKE', '%'.$searchWord.'%');
                });
                unset($filter['query']);
            }
        }

        return parent::buildQueryByFilter($query, $filter);
    }
}
