<?php
namespace App\Services\Production;

use App\Services\APIUserServiceInterface;

class APIUserService extends UserService implements APIUserServiceInterface
{
    public function getGuardName()
    {
        return 'api';
    }
}
