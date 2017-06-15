<?php
namespace App\Http\Middleware\Api\V1;

class SetDefaultValues
{
    /**
     * Create a new filter instance.
     */
    public function __construct()
    {
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
        return $next($request);
    }
}
