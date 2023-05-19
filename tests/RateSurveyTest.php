<?php
declare(strict_types=1);

namespace Tests;
require_once(dirname(__DIR__)."/helpers.php");

use PHPUnit\Framework\TestCase;
use App\Db;
use App\RateSurveyFactory;
use App\Interface\SurveyFactory;
use App\RateSurvey;
use App\Interface\Survey;
use App\Interface\Generator;

class RateSurveyTest extends TestCase
{
    
    protected $database;
    protected $survey;
    
    public function setUp(): void
    {
        $this->factory = new RateSurveyFactory();
        $this->survey = $this->factory->makeSurvey();
    }

    public function test_what_vote_save_in_db()
    {
        $data = [
            'token' => 'f547ee734f946b4e0e0b7a751f42041d',
            'result' => '4'
        ];
        Db::getInstance()->beginTransaction();
        $result = $this->survey->vote($data['token'], $data['result']);
        Db::getInstance()->rollback();  
        $this->assertTrue($result);
    }
    public function test_what_vote_not_save_with_invalid_data()
    {
        $data = [
            'token' => 'f547ee734f946b4e0e0b7a751f42041d',
            'result' => ''
        ];
        $this->expectException(\PDOException::class);
        Db::getInstance()->beginTransaction();
        $result = $this->survey->vote($data['token'], $data['result']);
        Db::getInstance()->rollback();  
    }

    public function test_what_existing_token_return_true()
    {
        // Токен берется из БД
        $token = '1e925e7299a50c56189ff3502c14d2df';
        $result = $this->survey->getToken($token);
        $this->assertTrue($result);
    }
    public function test_what_not_existing_token_return_false()
    {
        // Несуществующий в БД токен
        $token = 'f547ee734f946b4e0e0b7a751f42041d';
        $result = $this->survey->getToken($token);
        $this->assertFalse($result);
    }
}