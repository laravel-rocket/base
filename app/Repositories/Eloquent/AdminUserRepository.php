<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\AdminUserRepositoryInterface;
use App\Models\AdminUser;

class AdminUserRepository extends SingleKeyModelRepository implements AdminUserRepositoryInterface
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
