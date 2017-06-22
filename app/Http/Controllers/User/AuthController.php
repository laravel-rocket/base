<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\UserServiceInterface;

class AuthController extends Controller
{
    /** @var \App\Services\UserServiceInterface UserService */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function getSignIn()
    {
        return view('pages.user.auth.signin', [
        ]);
    }

    public function postSignIn(SignInRequest $request)
    {
        $user = $this->userService->signIn($request->all());
        if (empty($user)) {
            return redirect()->action('User\AuthController@getSignIn');
        }

        return \RedirectHelper::intended(action('User\IndexController@index'));
    }

    public function getSignUp()
    {
        return view('pages.user.auth.signup', [
        ]);
    }

    public function postSignUp(SignUpRequest $request)
    {
        $user = $this->userService->signUp($request->all());
        if (empty($user)) {
            return redirect()->action('User\AuthController@getSignUp');
        }

        return \RedirectHelper::intended(action('User\IndexController@index'));
    }

    public function postSignOut()
    {
        $this->userService->signOut();

        return \Redirect::action('User\AuthController@getSignIn');
    }
}
