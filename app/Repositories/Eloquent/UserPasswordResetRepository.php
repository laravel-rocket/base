<?php
namespace App\Repositories\Eloquent;

use App\Repositories\UserPasswordResetRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\PasswordResettableRepository;

class UserPasswordResetRepository extends PasswordResettableRepository implements UserPasswordResetRepositoryInterface
{
    protected $tableName = 'password_resets';
}
