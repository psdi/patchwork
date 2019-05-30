<?php
declare(strict_types=1);

$mainPath = dirname(__DIR__);
require $mainPath . '/src/autoload.php';
$request = new Http\Request();
$router = (require $mainPath . '/config/routes.php')($request);
$dispatcher = new Routing\Dispatcher($router);
$dispatcher->dispatch();

exit();

$logger = new Library\Logger($mainPath . '/test/data/logs');
