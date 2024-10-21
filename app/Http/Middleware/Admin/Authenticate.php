<?php

namespace App\Http\Middleware\Admin;

use App\Services\AdminUserServiceInterface;
use Closure;

class Authenticate
{
    /** @var AdminUserServiceInterface */
    protected $adminUserService;

    /**
     * Create a new filter instance.
     */
    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->adminUserService->isSignedIn()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return \RedirectHelper::guest(
                    action('Admin\AuthController@getSignIn'),
                    $this->adminUserService->getGuardName()
                );
            }
        }
        view()->share('authUser', $this->adminUserService->getUser());

        return $next($request);
    }
}
