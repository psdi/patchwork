<?php

use Routing\Router;
use Http\Request;

return function (Request $request) {
    $router = new Router($request);

    $router->addRoute('/hello/:lang/:num', 'GET', [ 'Controllers\TestController::returnAction' ], [
        'required' => [
            'lang' => '\w+',
            'num' => '\d+',
        ],
    ]);

    $router->addRoute('/hello', 'GET', [ 'Controllers\TestController::listAction' ]);

    $router->processRequest();

    return $router;
};