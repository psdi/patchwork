<?php

require 'public/Loader.php';
$loader = new Library\Loader();

$loader->addNamespace('Library', 'public');
$loader->addNamespace('App', 'src');

$loader->register();

// test
$logger = new Library\Logger(dirname(__FILE__) . '/data/logs');
$logger->write(__CLASS__, __METHOD__, 'success', 'I did it! Or rather, I implemented a thing that was already given in the interwebs haha');