<?php

namespace App\Enums;

enum EventStatusEnum : string
{
    case SCHEDULED = 'scheduled';
    case ONGOING = 'ongoing';
    case COMPLETE = 'complete';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'scheduled',
            self::ONGOING => 'ongoing',
            self::COMPLETE => 'complete',
        };
    }
}
