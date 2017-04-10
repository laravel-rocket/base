<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\AuthenticatableRepository;

class UserRepository extends AuthenticatableRepository implements UserRepositoryInterface
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
