<?php
    $files = glob('*.php',GLOB_NOSORT);
    $files = array_diff($files,['index.php','autoload_Composer.php']);
?><!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <title>csstool/tests</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    *,*:before,*:after {
        box-sizing: border-box;
    }
    html,body {
        padding: 0;
        margin: 0;
        font-family: sans-serif;
        width: 100%;
    }
    body {
        position: relative;
    }
    a {
        text-decoration: none;
    }
    h1 {
        margin-top: 0;
    }
    #tests_list {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        padding: 20px 10px;
        background: #f5f5f5;
        width: 30%;
        min-height: 100vh;
        border-left: 2px solid rgba(0,0,0,.05);
    }
    #tests_viewer {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 70%;
        min-height: 100vh;
        border: 0;
    }
  </style>
</head>
<body>
<div id='tests_list'>
<h1>Tests</h1>
<?php
    echo '<ol>';
    foreach($files as $file){
        echo "<li><a href='{$file}' target='tests_viewer'>{$file}</a></li>";
    }
    echo '</ol>';
?>
</div>
<iframe id='tests_viewer' src='' name='tests_viewer'></iframe>



</body>
</html>