<?php

namespace SimpleRest\Router;

/**
 * Route
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Route
{
    /**
     * @var string
     */
    private $path;
    
    /**
     * @var string
     */
    private $controller;
    
    /**
     * @var string
     */
    private $action;
    
    /**
     * @var string
     */
    private $method;

    /**
     * path ~/^someRoute~ will match only /someRoute
     *
     * path ~/^.*~ will match /{anything}
     *
     * path ~/^([0-9]+)~ will match /{number}
     * and {number} will be passed to the controller
     *
     * @param string $path Regexp expression for route match
     * @param string $controller Controller class
     * @param string $action HTTP request type
     * @param string $method Method to call from controller
     */
    public function __construct($path, $controller, $action, $method)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->action =$action;
        $this->method = $method;
    }
    
    /**
     * URL matching the route
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Return controller class name
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Return controller method
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Return request method
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }
}
