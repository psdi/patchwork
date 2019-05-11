<?php
declare(strict_types=1);

$mainPath = dirname(__DIR__);
require $mainPath . '/src/autoload.php';
$request = new Http\Request();
$router = (require $mainPath . '/config/routes.php')($request);
$dispatcher = new Routing\Dispatcher($router);
$dispatcher->dispatch();
// todo: clean me up
exit();

$logger = new Library\Logger($mainPath . '/test/data/logs');

$testClass = new Test\Foo\Bar\TestClass();
$testClass->sayHello();

$randomizer = new Test\Baz\Randomizer();
echo $randomizer->random();