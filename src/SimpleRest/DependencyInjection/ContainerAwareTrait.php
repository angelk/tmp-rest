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
    
    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * @inheritdoc
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * Shortcut form container->get
     * @param string $key
     * @return mixed
     */
    protected function get($key)
    {
        return $this->container->get($key);
    }
}
