<?php

namespace App\Interface;

use App\Interface\Survey;
use App\Interface\Generator;

interface SurveyFactory
{
    public function makeGenerator(): Generator;
    public function makeSurvey(): Survey;

}