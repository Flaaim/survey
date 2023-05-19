<?php

namespace App;

class Db
{   
    private static $instance = null;

    private function __construct()
    {}

    public static function getInstance()
    {
        require_once ROOT."/db.php";
        if(!self::$instance){
            return self::$instance = new \PDO($conn['dsn'],$conn['user'], $conn['password'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        }
        return self::$instance;
    }
}