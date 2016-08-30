<?php

return [
    [
        'path' => '~^/$~',
        'controller' => \SimpleRest\Controller\NewsController::class,
        'action' => 'indexAction',
        'method' => 'GET',
    ],
    [
        'path' => '~^/([0-9]+)$~',
        'controller' => \SimpleRest\Controller\NewsController::class,
        'action' => 'getAction',
        'method' => 'GET',
    ],
    [
        'path' => '~^/$~',
        'controller' => \SimpleRest\Controller\NewsController::class,
        'action' => 'postAction',
        'method' => 'POST',
    ],
    [
        'path' => '~^/([0-9]+)$~',
        'controller' => \SimpleRest\Controller\NewsController::class,
        'action' => 'deleteAction',
        'method' => 'DELETE',
    ],
];
