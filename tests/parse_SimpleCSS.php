<?php
/*
 * Testing simple parsing
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo "Set initial CSS through an string" . PHP_EOL . PHP_EOL;
$CSS->set('html,body {margin:0; padding:0px;}strong{font-weight: 600;}p{color: red;}');
// Output
var_dump($CSS->get());