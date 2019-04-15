<?php

require 'public/Autoloader.php';
$loader = new Library\Autoloader();

$loader->addNamespace('Library', 'public/');
$loader->addNamespace('App', 'src/');
$loader->addNamespace('Test\\Foo\\Bar', 'test/foo/bar/');

$loader->register();

// test
$logger = new Library\Logger(dirname(__FILE__) . '/data/logs');
$logger->write(__CLASS__, __METHOD__, 'success', 'I did it! Or rather, I implemented a thing that was already given in the interwebs haha');

$testClass = new Test\Foo\Bar\TestClass();
