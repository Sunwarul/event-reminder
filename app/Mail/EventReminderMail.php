<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $recipient;

    public function __construct($event, $recipient)
    {
        $this->event = $event;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this->subject('Event Reminder: ' . $this->event->name)
            ->view('emails.event_reminder');
    }
}
