<?php

// Classes before autoload
$class_before_autoload = get_declared_classes();

// Includes the autoload :D
require  'vendor/autoload.php';

// Classes after autoload
$class_after_autoload = get_declared_classes();

// Keep only what's different between the two arrays
$only_different = array_diff($class_after_autoload, $class_before_autoload);

echo '<pre>';
var_dump($only_different);

