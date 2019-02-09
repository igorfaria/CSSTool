<?php
/*
 * Testing the method CSSTool\CSS->append($string)
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;

echo 'Append the first rule (string)' . PHP_EOL . PHP_EOL; 
$CSS->append('body{color:blue}');
// 1st Output
var_dump($CSS->get());

echo PHP_EOL;
echo 'Append the second rule (array)' . PHP_EOL . PHP_EOL; 
$CSS->append(['p' => ['margin' => '10px']]);
// 2nd Output
var_dump($CSS->get());