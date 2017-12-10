<?php
namespace App\Http\Middleware\User;

use App\Services\UserServiceInterface;

class SetDefaultValues
{
    /** @var UserServiceInterface */
    protected $userService;

    /**
     * Create a new filter instance.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $user = $this->userService->getUser();
        view()->share('authUser', $user);

        $queryParameters = [];
        parse_str($request->getQueryString(), $queryParameters);
        view()->share('queryParameters', $queryParameters);

        return $next($request);
    }
}
