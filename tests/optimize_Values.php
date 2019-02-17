<?php
/*
 * Testing optimizing values from properties :D
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo 'Load local file "./css/optimize_values.css"' . PHP_EOL . PHP_EOL;
$CSS->load('css/optimize_values.css');

$output = $CSS->get('string');
echo 'Output before optimizing ('.strlen($output).'): ' . PHP_EOL . PHP_EOL;
echo $output;

// Optimize
$CSS->optimize();

$output = $CSS->get('string');
echo PHP_EOL . PHP_EOL . 'Output after optimizing ('.strlen($output).'): ' . PHP_EOL . PHP_EOL;
echo $output;
