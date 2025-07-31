<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'start_time',
        'end_time',
        'description',
        'location',
        'organizer',
        'status',
        'type',
        'url',
        'image',
        'created_by',
    ];
}
