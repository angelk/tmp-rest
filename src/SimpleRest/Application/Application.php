<?php

namespace SimpleRest\Application;

/**
 * Application
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Application
{
    public function run($request)
    {
        $this->initErrorHandler();

        try {
            $router = new \SimpleRest\Router\Router();
            $router->addRoute(
                new \SimpleRest\Router\Route(
                    '/',
                    \SimpleRest\Controller\NewsController::class,
                    'indexAction',
                    'GET'
                )
            );

            $machedRoute = $router->matchRoute($request);
            
            $controllerClass = $machedRoute->getController();
            $controller = new $controllerClass();
            $controllerMethod = $machedRoute->getAction();
            $response = call_user_func_array(
                [$controller, $controllerMethod],
                [] // add parameters from oruter
            );
            
            if (! $response instanceof \Psr\Http\Message\ResponseInterface) {
                throw new \SimpleRest\Exception\Exception("Controller should return response object");
            }
            
            http_response_code($response->getStatusCode());
            echo $response->getBody();
        } catch (\SimpleRest\Exception\Exception $e) {
            header('Content-Type: application/json');
            http_response_code(500);
            $jsonData = [
                'error' => [
                    'msg' => $e->getMessage()
                ],
            ];
            
            echo json_encode($jsonData);
        }
    }
    
    public function initErrorHandler()
    {
        $handler = new \SimpleRest\Error\ErrorHandler();
        $handler->register();
    }
}
