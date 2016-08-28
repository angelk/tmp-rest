<?php

require __DIR__ . '/../src/SimpleRest/Autoload/Autoloader.php';
require __DIR__ . '/../vendor/autoload.php';

$autoloader = new \SimpleRest\Autoload\Autoloader('SimpleRest', __DIR__ . '/../src/SimpleRest');
$autoloader->register();

$app = new \SimpleRest\Application\Application();

$request = \SimpleRest\Http\Request::createFromGlobals();
$app->run($request);
