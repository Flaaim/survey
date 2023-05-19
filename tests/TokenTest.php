<?php
declare(strict_types=1);
namespace Tests;

use PHPUnit\Framework\TestCase;
use App\RateSurveyFactory;
use App\Interface\SurveyFactory;
use App\RateSurvey;
use App\Interface\Survey;
use App\Interface\Generator;

class TokenTest extends TestCase
{
    protected $factory;
    protected $survey;
    protected $generator;

    public function setUp(): void
    {
        $this->factory = new RateSurveyFactory();
        $this->survey = $this->factory->makeSurvey();
        $this->generator = $this->factory->makeGenerator();
    }
    public function test_what_token_generate_return_string()
    {
        $token = $this->generator->generateLink();
        $this->assertIsString($token);
    }
    public function test_token_regex()
    {
        $token = $this->generator->generateLink();
        $this->assertMatchesRegularExpression("#^[a-f0-9]{32}$#", $token);
    }

}