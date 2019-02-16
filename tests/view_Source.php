<?php
    // To show the PHP code in tests/index.php
    if(isset($_GET['file'])) show_source($_GET['file']);

    // To show the PHP code via command line
    if(isset($argv[1])) {
        list($key, $val) = explode('=', $argv[1]);
        $CMD_ARG = array($key=> $val);
        if(isset($CMD_ARG['file'])){
            echo PHP_EOL;
            if(is_file($CMD_ARG['file'])){
                echo file_get_contents($CMD_ARG['file']) . PHP_EOL;
            } else {
                echo 'The file "' . $CMD_ARG['file'] . '" doesn\'t exist';
            }
            echo PHP_EOL;
        }
    }

?>