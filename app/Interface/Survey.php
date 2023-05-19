<?php

namespace App\Interface;

interface Survey
{
    public function getPoll(): string;

    public function vote($token, $value): bool;
}