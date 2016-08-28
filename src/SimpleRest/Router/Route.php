<?php

namespace SimpleRest\Router;

/**
 * Route
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Route
{
    private $path;
    private $controller;
    private $action;
    private $method;


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
