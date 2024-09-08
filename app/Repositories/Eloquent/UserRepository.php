<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use LaravelRocket\Foundation\Models\Base;
use LaravelRocket\Foundation\Repositories\Eloquent\AuthenticatableRepository;

class UserRepository extends AuthenticatableRepository implements UserRepositoryInterface
{
    public function getBlankModel(): User
    {
        return new User();
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
            if (!empty($searchWord)) {
                $query = $query->where(function ($q) use ($searchWord) {
                    $q->where('name', 'LIKE', '%'.$searchWord.'%');
                });
                unset($filter['query']);
            }
        }

        return parent::buildQueryByFilter($query, $filter);
    }

}
