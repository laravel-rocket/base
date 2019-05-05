<?php
namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Arr;
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

    protected function buildQueryByFilter($query, $filter)
    {
        if (array_key_exists('query', $filter)) {
            $searchWord = Arr::get($filter, 'query');
            if (!empty($searchWord)) {
                $query = $query->where(function ($q) use ($searchWord) {
                    $q->where('original_file_name', 'LIKE', '%'.$searchWord.'%');
                });
                unset($filter['query']);
            }
        }

        return parent::buildQueryByFilter($query, $filter);
    }
}
