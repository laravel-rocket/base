<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Services\AdminUserServiceInterface;

class AuthController extends Controller
{
    /** @var \App\Services\AdminUserServiceInterface AdminUserService */
    protected $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    public function getSignIn(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.admin.auth.signin', [
        ]);
    }

    public function postSignIn(SignInRequest $request): \Illuminate\Http\RedirectResponse
    {
        $adminUser = $this->adminUserService->signIn($request->all());
        if (empty($adminUser)) {
            return redirect()->action('Admin\AuthController@getSignIn');
        }

        return \RedirectHelper::intended(
            action('Admin\IndexController@index'),
            $this->adminUserService->getGuardName()
        );
    }

    public function postSignOut(): \Illuminate\Http\RedirectResponse
    {
        $this->adminUserService->signOut();

        return redirect()->action('Admin\AuthController@getSignIn');
    }
}
