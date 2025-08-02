<?php

namespace App\Enums;

enum EventStatusEnum: string
{
    case SCHEDULED = 'Scheduled';
    case ONGOING = 'On-going';
    case COMPLETE = 'Complete';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Scheduled',
            self::ONGOING => 'On-going',
            self::COMPLETE => 'Complete',
        };
    }
}
