<?php

namespace App\Enums;

enum EventTypeEnum: string
{
    case CONFERENCE = 'conference';
    case WEBINAR = 'webinar';
    case MEETING = 'meeting';
    case WORKSHOP = 'workshop';
    case SEMINAR = 'seminar';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::CONFERENCE => 'Conference',
            self::WEBINAR => 'Webinar',
            self::MEETING => 'Meeting',
            self::WORKSHOP => 'Workshop',
            self::SEMINAR => 'Seminar',
            self::OTHER => 'Other',
        };
    }
}
