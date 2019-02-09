<?php
/*
 * Testing the method CSSTools\CSS->get($format=array,string,json);
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo 'Load local file "./css/simple.css"' . PHP_EOL . PHP_EOL;
$CSS->load('css/simple.css');

echo "Output \$CSS->get('array')" . PHP_EOL;
var_dump($CSS->get('array'));

echo PHP_EOL . "Output \$CSS->get('json')" . PHP_EOL;
echo($CSS->get('json'));

echo PHP_EOL .PHP_EOL . "Output \$CSS->get('string')" . PHP_EOL;
echo($CSS->get('string'));