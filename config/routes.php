<?php

use Routing\Router;
use Http\Request;

return function (Request $request) {
    $router = new Router($request);

    $router->addRoute('/hello/:lang', 'GET', [ 'Controllers\TestController', 'returnAction' ], [
        'required' => [ 'lang' => '\w+' ],
        // 'default' => [ 'lang' => 'en' ],
    ]);

    $router->addRoute('/hello', 'GET', [ 'Controllers\TestController', 'listAction' ]);

    echo '<pre>';

    $router->processRequest();

    return $router;

    /** order of events:
     *  - router receives request
     *  - all routes are added as an array!
     *  - meanwhile, request uri will be broken down and stuff will be identified (no checking for controller yet)
     *      - im Prinzip kann man sowas von /(\w)+/*(\w)* als einzige Route hinzufügen hahaha
     *  - router and request are passed on to dispatcher, which does the actual dispatching
     */
};