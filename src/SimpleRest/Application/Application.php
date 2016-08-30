<?php

namespace SimpleRest\Application;

use SimpleRest\Http\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Application
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Application
{
    public function run($request)
    {
        try {
            $this->initErrorHandler();
            
            $router = new \SimpleRest\Router\Router();
            $router->addRoutes(require __DIR__ . '/../../../config/routes.php');

            $machedRouteData = $router->matchRoute($request);
            $machedRoute = $machedRouteData['route'];
            
            $container = new \SimpleRest\DependencyInjection\Container();
            $container->add('request', $request);
            
            $controllerClass = $machedRoute->getController();
            $controller = new $controllerClass();
            
            if ($controller instanceof \SimpleRest\DependencyInjection\ContainerAwareInterface) {
                $controller->setContainer($container);
            }
            
            $container->add('db', $this->initDb());
            $container->add('newsQuery', function () use ($container) {
                return new \SimpleRest\Orm\News\Query($container->get('db'));
            });
            
            $controllerMethod = $machedRoute->getAction();
            $response = call_user_func_array(
                [$controller, $controllerMethod],
                $machedRouteData['routeParameters']
            );
            
            if (! $response instanceof ResponseInterface) {
                throw new \SimpleRest\Exception\Exception("Controller should return response object");
            }
            
            $this->sendResponse($response);
        } catch (\SimpleRest\Exception\Exception $e) {
            $response = new Response();
            $response->setStatusCode(500);
            $response->addHeader('Content-Type', 'application/json');
            
            $jsonData = [
                'error' => [
                    'msg' => $e->getMessage()
                ],
            ];
            
            $response->setBody(json_encode($jsonData));
            $this->sendResponse($response);
        }
    }
    
    protected function sendResponse(ResponseInterface $response)
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $headerName => $headerValues) {
            $headerData = $headerName . ': ' . implode(',', $headerValues);
            header($headerData);
        }
        echo $response->getBody();
    }
    
    
    public function initErrorHandler()
    {
        $handler = new \SimpleRest\Error\ErrorHandler();
        $handler->register();
    }
    
    public function initDb()
    {
        $dbSettings = require __DIR__ . '/../../../config/db.php';
        $pdo = new \PDO(
            "mysql:dbname={$dbSettings['database']};host={$dbSettings['host']}",
            $dbSettings['user'],
            $dbSettings['password']
        );
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
