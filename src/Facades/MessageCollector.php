<?php

namespace OneThirtyOne\Mime\Facades;

use Illuminate\Support\Facades\Facade;

class MessageCollector extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'message-collector';
    }
}
