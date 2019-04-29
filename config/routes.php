<?php

use Routing\Router;
use Http\Request;

return function (Request $request) {
    $router = new Router($request);

    $router->addRoute('/hello', 'GET', function() {
        echo 'Hello!';
    });

    return $router;
};