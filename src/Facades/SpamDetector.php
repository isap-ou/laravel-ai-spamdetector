<?php

namespace Isapp\LaravelAiSpamdetector\Facades;

use Illuminate\Support\Facades\Facade;

use function xdebug_break;

class SpamDetector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'ai-spamdetector';
    }
}
