<?php

/*
 * Testing the autoload in development
*/

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;

$CSS->set('strong{font-weight: 600;}');

$CSS->append('p{color: red;}');

$CSS->prepend('html,body {margin:0; padding:0;}');

// Output
echo '<pre>';
var_dump($CSS->get());