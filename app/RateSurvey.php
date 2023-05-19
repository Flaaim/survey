<?php

namespace App;

use App\Interface\Survey;
use App\Db;

class RateSurvey implements Survey
{
    const START = 0;
    const END = 10;

    public function getPoll(): string
    {
        $html = '';
        $html .= "<p><strong>Пожалуйста оцените компанию по 10 бальной шкале</strong></p>";
        $html .= "<div class='btn-toolbar justify-content-center' role='toolbar'>";
        for($i= self::START; $i<= self::END; $i++){
            $html .= "<a class='btn btn-light mx-1' href='?value=$i'>$i</a>";
        }
        $html .= "</div>";
        return $html;
    }

    public function vote($token, $value): bool
    {
        $sql = "INSERT INTO rateSurvey (token, result) VALUES (?, ?)";
        try{
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->execute([$token, $value]);
            
            return true;
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getToken($token): bool
    {
        $sql = "SELECT token FROM rateSurvey WHERE token = ?";
        try{
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->execute([$token]);
            return $stmt->fetchColumn();
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}