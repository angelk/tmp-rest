<?php

namespace SimpleRest\DependencyInjection;

/**
 * Container
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Container
{
    private $services = [];
    
    public function add($key, $service)
    {
        $this->services[$key] = $service;
    }
    
    public function get($key)
    {
        if (is_callable($this->services[$key])) {
            $callable = $this->services[$key];
            $this->services[$key] = $callable();
        }
        return $this->services[$key];
    }
}
