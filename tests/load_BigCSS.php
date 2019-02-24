<?php
/*
 * Testing to load a simple CSS from a local file
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo 'Load local file "./css/big.css"' . PHP_EOL . PHP_EOL;
$CSS->load('css/big.css');
// Output
var_dump($CSS->get('string', false));