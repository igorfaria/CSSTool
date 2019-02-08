<?php

/*
 * Testing the autoload in development
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;
// Load local file
$CSS->load('css/simple.css');
// Output
var_dump($CSS->get());