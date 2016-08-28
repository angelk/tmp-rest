<?php

namespace SimpleRest\Router;

use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var Route[]
     */
    private $routes;
    
    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $this->addRoute($route);
        }
    }
    
    /**
     * @param Route|Array $route
     * @throws \SimpleRest\Exception\Exception
     */
    public function addRoute($route)
    {
        if ($route instanceof Route) {
            $this->routes[] = $route;
        } elseif (is_array($route)) {
            $routeObject = new Route(
                $route['path'],
                $route['controller'],
                $route['action'],
                $route['method']
            );
            
            $this->routes[] = $routeObject;
        } else {
            throw new \SimpleRest\Exception\Exception("unknown type");
        }
    }
    
    /**
     * @param ServerRequestInterface $request
     * @return Array
     */
    public function matchRoute(ServerRequestInterface $request)
    {
        $serverParams = $request->getServerParams();
        if (isset($serverParams['PATH_INFO'])) {
            $requiredPath = $serverParams['PATH_INFO'];
        } else {
            $requiredPath = '/';
        }
        
        $routeParams = [];
        foreach ($this->routes as $route) {
            if ($route->getMethod() === $request->getMethod()) {
                if (preg_match($route->getPath(), $requiredPath, $routeParams)) {
                    array_shift($routeParams);
                    return [
                        'route' => $route,
                        'routeParameters' => $routeParams,
                    ];
                }
            }
        }
        
        // @TOOD change to route exception
        throw new \SimpleRest\Exception\Exception("'{$requiredPath}' have no maching route");
    }
}
