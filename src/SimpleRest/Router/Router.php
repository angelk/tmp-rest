<?php

namespace SimpleRest\Router;

use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var Route[]
     */
    private $routes;
    
    public function addRoute($route)
    {
        $this->routes[] = $route;
    }
    
    /**
     * @param ServerRequestInterface $request
     * @return Route
     */
    public function matchRoute(ServerRequestInterface $request)
    {
        $serverParams = $request->getServerParams();
        if (isset($serverParams['PATH_INFO'])) {
            $requiredPath = $serverParams['PATH_INFO'];
        } else {
            $requiredPath = '/';
        }
        
        foreach ($this->routes as $route) {
            if ($route->getPath() === $requiredPath && $request->getMethod() === $route->getMethod()) {
                return $route;
            }
        }
        
        // @TOOD change to route exception
        throw new \SimpleRest\Exception\Exception("'{$requiredPath}' have no maching route");
    }
}
