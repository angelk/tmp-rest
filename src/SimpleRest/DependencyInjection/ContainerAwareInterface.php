<?php

namespace SimpleRest\DependencyInjection;

use SimpleRest\DependencyInjection\Container;

/**
 *
 * @author po_taka
 */
interface ContainerAwareInterface
{
    /**
     * @return Container
     */
    public function getContainer();
    public function setContainer(Container $container);
}
