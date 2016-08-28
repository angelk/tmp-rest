<?php

namespace SimpleRest\Router;

/**
 * Description of Route
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
    
    function getPath()
    {
        return $this->path;
    }

    function getController()
    {
        return $this->controller;
    }

    function getAction()
    {
        return $this->action;
    }

    function getMethod()
    {
        return $this->method;
    }
}
