<h2>Event Reminder</h2>
<p>Hello,</p>
<p>This is a reminder for the event: <strong>{{ $event->name }}</strong></p>
<ul>
    <li><strong>Start:</strong> {{ $event->start_time }}</li>
    <li><strong>End:</strong> {{ $event->end_time }}</li>
    <li><strong>Description:</strong> {{ $event->description }}</li>
    <li><strong>Location:</strong> {{ $event->location }}</li>
    <li><strong>Organizer:</strong> {{ $event->organizer }}</li>
    <li><strong>URL:</strong> <a href="{{ $event->url }}">{{ $event->url }}</a></li>
</ul>
<p>Thank you!</p>
