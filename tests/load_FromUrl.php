<?php
/*
 * Testing to load a simple CSS from a URL
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

// :D
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$link = str_replace(basename(__FILE__),'', $link);

$link_css = $link . 'css/simple.css';

// Create an instance 
$CSS = new CSSTool\CSS;
echo "Load file from {$link_css}" . PHP_EOL . PHP_EOL;
$CSS->load($link_css);
// Output
var_dump($CSS->get());