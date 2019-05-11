<?php

require 'lib/Autoloader.php';

$frameworkPath = rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR) . '/';
$projectPath = rtrim(dirname(__FILE__, 2), DIRECTORY_SEPARATOR) . '/test/';
//todo: add paths to config file
$loader = new Library\Autoloader($frameworkPath, $projectPath);

$loader->addNamespace('Library', 'lib/');
$loader->addNamespace('Routing', 'routing/');
$loader->addNamespace('Http', 'http/');

$loader->addNamespaceGroup('Test', 'test/', function (Library\Autoloader $a) {
    $a->addNamespace('Foo\\Bar\\', 'foo/bar/');
    $a->addNamespace('Baz\\', 'baz/');
});

$loader->addNamespace('App', 'app/');

$loader->addNamespace('Controllers', 'controllers/');

$loader->register();
