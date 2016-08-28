<?php

return [
    [
        'path' => '~^/$~',
        'controller' => \SimpleRest\Controller\NewsController::class,
        'action' => 'indexAction',
        'method' => 'GET',
    ],
    [
        'path' => '~^/(?P<id>[0-9]+)$~',
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
