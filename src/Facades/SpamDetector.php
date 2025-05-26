<?php

namespace Isapp\LaravelAiSpamdetector\Facades;

use Illuminate\Support\Facades\Facade;

class SpamDetector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Isapp\AiSpamdetector\SpamDetector::class;
    }
}
