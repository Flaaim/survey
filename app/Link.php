<?php

namespace App;

use App\Interface\Generator;

class Link implements Generator
{
    public function generateLink(): string
    {
        return md5(uniqid(rand(), true));
    }
}