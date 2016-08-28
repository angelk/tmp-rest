<?php

namespace SimpleRest\DependencyInjection;

use SimpleRest\DependencyInjection\Container;

/**
 *
 * @author po_taka
 */
interface ContainerAwareInterface
{
    public function getContainer();
    public function setContainer(Container $container);
}
