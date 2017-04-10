<?php
namespace App\Repositories\Eloquent;

use App\Repositories\AdminPasswordResetRepositoryInterface;
use LaravelRocket\Foundation\Repositories\Eloquent\PasswordResettableRepository;

class AdminPasswordResetRepository extends PasswordResettableRepository implements AdminPasswordResetRepositoryInterface
{
    protected $tableName = 'admin_password_resets';
}
