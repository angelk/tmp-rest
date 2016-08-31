<?php

require __DIR__ . '/../../vendor/autoload.php';

require __DIR__ . '/../../src/SimpleRest/Autoload/Autoloader.php';
$autoloader = new \SimpleRest\Autoload\Autoloader('SimpleRest', __DIR__ . '/../../src/SimpleRest');
$autoloader->register();
