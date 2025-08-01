<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $casts = [
        'start_time' => 'datetime:j F, Y H:i A',
        'end_time' => 'datetime:j F, Y H:i A',
        'status' => 'string',
        'type' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
