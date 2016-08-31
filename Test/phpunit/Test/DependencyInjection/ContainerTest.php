<?php

namespace Test\DependencyInjection;

use PHPUnit\Framework\TestCase;
use SimpleRest\DependencyInjection\Container;

/**
 * ContainerTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ContainerTest extends TestCase
{
    public function testContainerResolution()
    {
        $container = new Container();
        $testClass = new \stdClass();
        $container->add('t', $testClass);
        $this->assertSame($testClass, $container->get('t'));
    }
}
