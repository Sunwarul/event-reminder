<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Mail\EventReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders';
    protected $description = 'Send reminder emails for events to external recipients 1 hour before start';

    public function handle()
    {
        $now = Carbon::now();
        $target = $now->copy()->addHour()->format('Y-m-d H:i:00');
        $events = Event::where('start_time', $target)->get();
        foreach ($events as $event) {
            // Assume $event->external_emails is a comma-separated string of emails
            $recipients = array_filter(array_map('trim', explode(',', $event->external_emails ?? '')));
            foreach ($recipients as $recipient) {
                Mail::to($recipient)->queue(new EventReminderMail($event, $recipient));
            }
        }
        $this->info('Reminders sent for events starting at ' . $target);
    }
}
