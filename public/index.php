<?php

require("../vendor/autoload.php");
require('../helpers.php');

use App\RateSurveyFactory;
use App\Link;
session_start();


$url = $_SERVER['REQUEST_URI'];

$rateSurveyFactory = new RateSurveyFactory();
$rateSurvey = $rateSurveyFactory->makeSurvey();
$rateSurveyLink = $rateSurveyFactory->makeGenerator();



$token = $_COOKIE['token'] ?? false;
if(!$token){
    $token = $rateSurveyLink->generateLink();
    setcookie('token', $token, time() + (10 * 365 * 24 * 60 * 60));
}

if(preg_match('#^/$#', $url)){
    $content = "<a href='/rate-company?token={$token}'>Пройдите тестирование</a>";
}elseif(preg_match("#^/rate-company\?token={$token}$#", $url)){ 
    $content = $rateSurvey->getPoll();
    
}elseif(preg_match("#^/rate-company\?value=[0-9]|10#", $url)){ 
    if(!$rateSurvey->getToken($token)){
        $value = $_GET['value'] ?? null;
        if($value){
            if($rateSurvey->vote($token, $value)){
                $_SESSION['success'] = "Спасибо, что оценили нас";
                redirect('/');
            }

        }
    }else{
        $_SESSION['errors'] = "Вы уже голосовали!";
        redirect('/');
    }
}else{
    throw new Exception("Страница не найдена", 404);
}

include ('../view/layout.php');