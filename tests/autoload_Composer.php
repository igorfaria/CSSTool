<?php

/*
 * Testing the autoload in development
*/

// Include the autoload :D
require  'vendor/autoload.php';

// Create an instance 
$CSS = new CSSTool\CSS;

// Output
echo '<pre>';
var_dump($CSS);