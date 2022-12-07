<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/start.php';

try{
    echo '<pre>';
    (new io\Main($config))->run();
    echo '</pre>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo (new helpers\Functions())->get_response_time();


    // echo '<pre>';
    // print_r($_SERVER);
    // echo '</pre>';
}
catch(Exception $e){
    echo $e;

    // echo $e->getMessage() . "<br/>";
    // while($e = $e->getPrevious()) {
    //     echo 'Previous exception: '.$e->getMessage() . "<br/>";
    // }
}

