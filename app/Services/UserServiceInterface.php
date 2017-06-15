<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\AuthenticatableServiceInterface;

interface UserServiceInterface extends AuthenticatableServiceInterface
{
    /**
     * @return \App\Models\User
     */
    public function getUser();
}
