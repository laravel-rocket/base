<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\PasswordRequest;
use App\Http\Responses\Api\V1\Status;
use App\Services\APIUserServiceInterface;
use App\Services\UserServiceInterface;

class PasswordController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Services\APIUserServiceInterface $userService */
    protected $apiUserService;

    public function __construct(
        UserServiceInterface $userService,
        APIUserServiceInterface $apiUserService
    ) {
        $this->userService    = $userService;
        $this->apiUserService = $apiUserService;
    }

    /**
     * @param \App\Http\Requests\Api\V1\Auth\PasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(PasswordRequest $request)
    {
        $email = $request->get('email');
        $this->apiUserService->sendPasswordResetEmail($email);

        return Status::ok()->response();
    }
}
