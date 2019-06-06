<?php

use Routing\Router;
use Http\Request;

return function (Request $request) {
    $router = new Router($request);

echo '<pre>';

    $router->addRoute('/hello/:lang/:num', 'GET', [ 'Controllers\TestController::returnAction' ], [
        'required' => [
            'lang' => '\w+',
            'num' => '\d+',
        ],
        // 'default' => [ 'lang' => 'en' ],
    ]);

    $router->addRoute('/hello', 'GET', [ 'Controllers\TestController::listAction' ]);

    $router->processRequest();

    return $router;
};