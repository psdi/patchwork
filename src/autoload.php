<?php

require 'lib/Autoloader.php';

$frameworkPath = rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR) . '/';
$loader = new Library\Autoloader($frameworkPath);

$loader->addNamespace('Library', 'lib/');

$loader->addNamespaceGroup('Test', 'test/', function (Library\Autoloader $a) {
    $a->addNamespace('Foo\\Bar', 'foo/bar/');
    $a->addNamespace('Baz', 'baz/');
});

$loader->register();

// test
$logger = new Library\Logger(dirname(__DIR__, 1) . '/test/data/logs');
$logger->write(__CLASS__, __METHOD__, 'success', 'I did it! Or rather, I implemented a thing that was already given in the interwebs haha');

$testClass = new Test\Foo\Bar\TestClass();
