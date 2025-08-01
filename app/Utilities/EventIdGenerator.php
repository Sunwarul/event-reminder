<?php

namespace App\Utilities;

use function strtoupper;
use function uniqid;

class EventIdGenerator
{
    public static function generate($prefix = null): string
    {
        $prefix = $prefix ?? env('EVENT_ID_PREFIX', 'EVT-');
        $uniqueId = uniqid($prefix, true);
        return strtoupper($uniqueId);
    }
}
