<?php

require 'public/Loader.php';
$loader = new Library\Loader();

$loader->addNamespace('Library', 'public');
$loader->addNamespace('App', 'src');

$loader->register();

// test
$logger = new Library\Logger(dirname(__FILE__) . '/data/logs');