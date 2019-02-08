<?php

/*
 * Testing the autoload in development
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
// Set initial CSS
$CSS->set('strong{font-weight: 600;}');
// Append a new rule
$CSS->append('p{color: red;}');
// Prepend another one
$CSS->prepend('html,body {margin:0; padding:0px;}');

// Output
var_dump($CSS->get());