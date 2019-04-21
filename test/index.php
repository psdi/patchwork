<?php
declare(strict_types=1);

require dirname(__DIR__, 1) . '/src/autoload.php';
require dirname(__DIR__, 1) . '/config/routes.php';
exit();

// test
$logger = new Library\Logger(dirname(__DIR__, 1) . '/test/data/logs');
$logger->write(__CLASS__, __METHOD__, 'new entry', 'ello, just moved some stuff');

$testClass = new Test\Foo\Bar\TestClass();
$testClass->sayHello();

$randomizer = new Test\Baz\Randomizer();
echo $randomizer->random();