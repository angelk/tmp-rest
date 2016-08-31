<?php

namespace Test\Router;

use PHPUnit\Framework\TestCase;
use SimpleRest\Router\Router;
use SimpleRest\Router\Route;
use SimpleRest\Http\Request;

/**
 * Description of RouterTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class RouterTest extends TestCase
{
    public function testRouteMatch()
    {
        $router = new Router();
        $route = new Route('~^/$~', 'TestController', 'TestAction', 'GET');
        $route2 = new Route('~^/$~', 'Test2Controller', 'TestAction', 'POST');
        $route3 = new Route('~^/test$~', 'Test2Controller', 'TestAction', 'GET');
        $router->addRoutes([$route, $route2, $route3]);
        
        $request = new Request([], [], ['REQUEST_METHOD' => 'GET', 'PATH_INFO' => '/'], []);
        $matchedRoute = $router->matchRoute($request);
        $this->assertSame(
            ['route' => $route, 'routeParameters' => []],
            $matchedRoute
        );
        
        $request2 = new Request([], [], ['REQUEST_METHOD' => 'POST', 'PATH_INFO' => '/'], []);
        $matchedRoute2 = $router->matchRoute($request2);
        $this->assertSame(
            ['route' => $route2, 'routeParameters' => []],
            $matchedRoute2
        );
    }
    
    public function testRouteMatchParams()
    {
        $router = new Router();
        $route = new Route('~/([a-z]+)~', 'TestController', 'TestAction', 'GET');
        $router->addRoute($route);
        
        $request = new Request([], [], ['REQUEST_METHOD' => 'GET', 'PATH_INFO' => '/asdf'], []);
        $matchedRoute = $router->matchRoute($request);
        $this->assertSame(
            ['route' => $route, 'routeParameters' => ['asdf']],
            $matchedRoute
        );
    }
    
    public function testNoRouteFound()
    {
        $this->expectException(\SimpleRest\Exception\Exception::class);
        $router = new Router();
        $route = new Route('~^/$~', 'TestController', 'TestAction', 'GET');
        $router->addRoute($route);
        
        $request = new Request([], [], ['REQUEST_METHOD' => 'GET', 'PATH_INFO' => '/qqqqqqq'], []);
        $router->matchRoute($request);
    }
}
