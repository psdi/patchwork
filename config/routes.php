<?php

use Routing\Dispatcher;
use Routing\RouteCollector;

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rtrim($_SERVER['REQUEST_URI'], '/');
$dispatcher = new Dispatcher(new RouteCollector());
$dispatcher->processRequest($httpMethod, $uri, $_GET, $_POST);

$dispatcher->addRoute('/hello', 'GET', function() {
    echo 'Hello!';
});

$dispatcher->run();