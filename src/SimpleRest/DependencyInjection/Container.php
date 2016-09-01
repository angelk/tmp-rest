<?php

namespace SimpleRest\DependencyInjection;

/**
 * Container
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Container
{
    /**
     * [serviceId] => value
     * @var array
     */
    private $services = [];
    
    /**
     * Add item in the container
     * @param string $key
     * @param mixed $service
     */
    public function add($key, $service)
    {
        $this->services[$key] = $service;
    }
    
    /**
     * Resolve item from container
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if (is_callable($this->services[$key])) {
            $callable = $this->services[$key];
            $this->services[$key] = $callable();
        }
        return $this->services[$key];
    }
}
