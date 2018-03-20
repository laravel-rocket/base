<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Responses\Api\Admin\Status;
use App\Services\AdminUserServiceInterface;

class AuthController extends Controller
{
    /** @var \App\Services\AdminUserServiceInterface AdminUserService */
    protected $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function postSignOut()
    {
        $this->adminUserService->signOut();

        return Status::ok()->response();
    }
}
