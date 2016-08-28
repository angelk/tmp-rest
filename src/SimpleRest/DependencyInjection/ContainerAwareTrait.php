<?php

namespace SimpleRest\DependencyInjection;

use SimpleRest\DependencyInjection\Container;

/**
 * ContainerAwareTrait
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
trait ContainerAwareTrait
{
    /**
     * @var Container
     */
    private $container;
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
    
    protected function get($key)
    {
        return $this->container->get($key);
    }
}
