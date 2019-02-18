<?php
    $files = glob('*.php',GLOB_NOSORT);
    $files = array_diff($files,['index.php','autoload_Composer.php','view_source.php']);
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
        background: #0c283e;
        width: 30%;
        min-height: 100vh;
        border-left: 2px solid rgba(0,0,0,.05);
        color: #fff;
    }
    #tests_list ul {
        padding-left: 10px;
    }
    #tests_list a {
        color: #ccc;
    }
    #tests_viewer {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 70%;
        min-height: 100vh;
        border: 0;
        background: #f0f0f0;
        filter: invert(1);
    }

    @media all and (max-width: 658px) and (min-width: 0){
        #tests_list {
            min-height: auto;
        }
        #tests_list,#tests_viewer {
            position: static;
            width: 100%;
        }
    }
  </style>
</head>
<body>
<div id='tests_list'>
<h1>Tests</h1>
<ol>
    <?php foreach($files as $file) {
        echo "
            <li>
                <a href='view_source.php?f={$file}' target='tests_viewer' class='view-source'><small>(source)</small></a>
                <a href='{$file}' target='tests_viewer'>{$file}</a>
            </li>";
    } ?>
</ol>
</div>
<iframe id='tests_viewer' src='<?php if(count($files)) echo $files[0]?>' name='tests_viewer'></iframe>



</body>
</html>