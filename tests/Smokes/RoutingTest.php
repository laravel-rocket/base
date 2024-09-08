<?php
namespace Tests\Smokes;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    protected $useDatabase = true;

    public function testRoute()
    {
        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $route) {
            if (in_array('GET', $route->methods) && strpos($route->uri, '{') === false
                && !Str::startsWith($route->uri, ['_debugbar'])) {
                $response = $this->call('GET', $route->uri);
                $this->assertTrue(
                    in_array($response->status(), [200, 201, 301, 302, 307, 401]),
                    $route->uri.' produces error'
                );
            }
        }
    }
}
