<?php
/*
 * Testing to save a simple CSS
*/
header('Content-type: text/plain;charset=utf8');

// Include the autoload :D
require  'vendor/autoload.php';

$filepath_to_be_saved = 'test_css/a/b/c/simple.css';

if(file_exists($filepath_to_be_saved)){
    echo 'Previous file "' . $filepath_to_be_saved . '" from a previous execution of this test' . PHP_EOL; 
    if(unlink($filepath_to_be_saved)){
        echo 'The file "' . $filepath_to_be_saved . '" was deleted' . PHP_EOL; 
    } else {
        echo 'Something went wrong while deleting a previous file created during this test' . PHP_EOL;
    }
}

// Create an instance 
$CSS = new CSSTool\CSS;
echo 'Load local file from "./css/simple.css"' . PHP_EOL . PHP_EOL;
$CSS->load('css/simple.css');

// Output
var_dump($CSS->get());

echo 'Saves in "'.$filepath_to_be_saved.'"' . PHP_EOL . PHP_EOL;
if($CSS->save($filepath_to_be_saved)){
    echo 'Saved with success!' . PHP_EOL;
}else {
    echo 'Something went wrong while saving...';
}