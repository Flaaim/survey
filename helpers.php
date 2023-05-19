<?php

define("ROOT", __DIR__);

function debug($data, $die = false){
    if($die){
        echo "<pre>".var_dump($data)."</pre>";
        die();
    }
    echo "<pre>".var_dump($data)."</pre>";
}

function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? _SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    die();
}

