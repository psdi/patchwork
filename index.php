<?php

require 'public/autoloader.php';

echo '<pre>';
$struct = json_decode(file_get_contents('structure.json'), true);
\Library\Autoloader::setRoot(__DIR__);
\Library\Autoloader::setNamespaceMap($struct);
spl_autoload_register('\Library\Autoloader::loader');
