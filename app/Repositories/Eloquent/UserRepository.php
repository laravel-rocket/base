<?php

namespace App\Repositories\Eloquent;

use LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends SingleKeyModelRepository implements UserRepositoryInterface
{

    public function getBlankModel()
    {
        return new User();
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
