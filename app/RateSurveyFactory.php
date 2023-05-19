<?php

namespace App;

use App\Interface\SurveyFactory;
use App\RateSurvey;
use App\Interface\Survey;
use App\Interface\Generator;

class RateSurveyFactory implements SurveyFactory
{

    public function makeSurvey(): Survey
    {
        return new RateSurvey();
    }

    public function makeGenerator(): Generator
    {
        return new Link();
    }

}