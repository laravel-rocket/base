<?php

namespace App\Repositories\Eloquent;

use App\Models\AdminUserRole;
use App\Repositories\AdminUserRoleRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;

class AdminUserRoleRepository extends SingleKeyModelRepository implements AdminUserRoleRepositoryInterface
{
    public function getBlankModel(): \LaravelRocket\Foundation\Models\Base
    {
        return new AdminUserRole;
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
}
