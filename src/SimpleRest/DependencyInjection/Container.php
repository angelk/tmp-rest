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
        return $this->services[$key];
    }
}
