<?php
/*
 * Testing parsing @medias
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo "Set initial CSS through a file " . PHP_EOL . PHP_EOL;
$CSS->load('css/medias.css');
// Output
var_dump($CSS->get());

echo PHP_EOL . PHP_EOL;
// Output
echo($CSS->get('string',false));