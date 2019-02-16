<?php
/*
 * Testing vendor autoprefixer
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
echo "Set load the initial CSS through a file" . PHP_EOL . PHP_EOL;
$CSS->load('css/autoprefixer.css');
// Output
//echo $CSS->get('string',false);

//echo PHP_EOL . 'Adds prefixes' . PHP_EOL . PHP_EOL;
// Output
echo $CSS->add_prefixes('string');