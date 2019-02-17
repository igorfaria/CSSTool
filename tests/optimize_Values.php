<?php
/*
 * Testing optimizing values from properties :D
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance with no autoprefixer and no optimization :D
$CSS = new CSSTool\CSS(['autoprefixer' => false, 'optimize' => false]);
echo 'Load local file "./css/optimize_values.css"' . PHP_EOL . PHP_EOL;
$CSS->load('css/optimize_values.css');

$output = $CSS->get('string', false);
echo 'Output before optimizing ('.strlen($output).'): ' . PHP_EOL . PHP_EOL;
echo $output;

// Create another instance with only no autoprefixer, the optimization is the default :D
$CSS2 = new CSSTool\CSS(['autoprefixer' => false]);
$CSS2->load('css/optimize_values.css');
// Optimize
$output = $CSS2->get('string', false);
echo PHP_EOL . PHP_EOL . 'Output after optimizing ('.strlen($output).'): ' . PHP_EOL . PHP_EOL;
echo $output;
