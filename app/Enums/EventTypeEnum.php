<?php

namespace App\Enums;

enum EventTypeEnum: string
{
    case CONFERENCE = 'Conference';
    case WEBINAR = 'Webinar';
    case MEETING = 'Meeting';
    case WORKSHOP = 'Workshop';
    case SEMINAR = 'Seminar';
    case OTHER = 'Other';

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
