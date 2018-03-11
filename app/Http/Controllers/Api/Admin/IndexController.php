<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StatusRequest;
use App\Http\Responses\Api\Admin\Information;
use App\Http\Responses\Api\V1\Status;
use App\Services\AdminUserServiceInterface;

class IndexController extends Controller
{
    /** @var \App\Services\AdminUserServiceInterface AdminUserService */
    protected $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function status(StatusRequest $request)
    {
        $authUser = $this->adminUserService->getUser();

        return Status::ok()->response();
    }

    public function information()
    {
        /** @var \App\Models\AdminUser $authUser */
        $authUser = $this->adminUserService->getUser();

        return Information::updateWithData($authUser, [])->response();
    }
}
