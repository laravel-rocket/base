<?php
namespace App\Http\Middleware\Api\V1;

use App\Exceptions\APIErrorException;
use App\Services\APIUserServiceInterface;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /** @var APIUserServiceInterface */
    protected $userService;

    /**
     * Create a new filter instance.
     *
     * @param APIUserServiceInterface $userService
     */
    public function __construct(APIUserServiceInterface $userService)
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
     *
     * @throws APIErrorException
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty($this->userService->isSignedIn())) {
            throw new APIErrorException('signInRequired', 'Not signed in', []);
        }

        return $next($request);
    }
}
