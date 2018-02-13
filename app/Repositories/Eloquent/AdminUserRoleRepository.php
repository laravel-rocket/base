<?php
namespace App\Repositories\Eloquent;

use App\Models\AdminUserRole;
use App\Repositories\AdminUserRoleRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class AdminUserRoleRepository extends SingleKeyModelRepository implements AdminUserRoleRepositoryInterface
{
    public function getBlankModel()
    {
        return new AdminUserRole();
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
        return parent::buildQueryByFilter($query, $filter);
    }
}
