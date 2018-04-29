<?php
namespace App\Repositories\Eloquent;

use App\Models\UserServiceAuthentication;
use App\Repositories\UserServiceAuthenticationRepositoryInterface;
use LaravelRocket\ServiceAuthentication\Repositories\Eloquent\ServiceAuthenticationRepository;

class UserServiceAuthenticationRepository extends ServiceAuthenticationRepository implements UserServiceAuthenticationRepositoryInterface
{
    public $authModelColumn = 'user_id';

    public function getBlankModel()
    {
        return new UserServiceAuthentication();
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
