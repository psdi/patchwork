<?php

require 'public/Autoloader.php';

$things = 'hello';
echo (require 'config/routes.php')($things);

echo '<pre>';
$struct = json_decode(file_get_contents('structure.json'), true);
\Library\Autoloader::setRoot(__DIR__);
\Library\Autoloader::setNamespaceMap($struct);
spl_autoload_register('\Library\Autoloader::loader');

$logger = new Library\Logger('data/logs/');