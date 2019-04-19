<?php

require 'lib/Autoloader.php';

$frameworkPath = rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR) . '/';
$loader = new Library\Autoloader($frameworkPath);

$loader->addNamespace('Library', 'lib/');

$loader->addNamespaceGroup('Test', 'test/', function (Library\Autoloader $a) {
    $a->addNamespace('Foo\\Bar\\', 'foo/bar/');
    $a->addNamespace('Baz\\', 'baz/');
});

$loader->register();
