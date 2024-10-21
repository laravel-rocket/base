<?php

namespace App\Http\Middleware\User;

use App\Services\UserServiceInterface;

class RedirectIfAuthenticated
{
    /** @var UserServiceInterface */
    protected $userService;

    /**
     * Create a new filter instance.
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($this->userService->isSignedIn()) {
            return redirect()->action('User\IndexController@index');
        }

        return $next($request);
    }
}
