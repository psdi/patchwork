<?php

require 'public/Loader.php';
$loader = new Library\Loader();

$loader->addNamespace('Library', '/public');
$loader->addNamespace('App', '/src');

// maybe add possibility to register whole arrays of namespaces?