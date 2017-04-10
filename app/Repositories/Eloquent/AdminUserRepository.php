<?php
namespace App\Repositories\Eloquent;

use App\Models\AdminUser;
use App\Repositories\AdminUserRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\AuthenticatableRepository;

class AdminUserRepository extends AuthenticatableRepository implements AdminUserRepositoryInterface
{
    public function getBlankModel()
    {
        return new AdminUser();
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
