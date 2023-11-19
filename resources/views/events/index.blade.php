@extends('navbar')


@section('content')
    <div class="events-container" style="margin-top: 60px;">
    <form action="{{ route('events.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search events...">
        <button type="submit">Search</button>
    </form>

        <h1>Events</h1>
        <p>Here you can see all the events that are available.</p>
    @if(count($events) > 0)
    @foreach($events as $event)
    <div>
        <h2>{{ $event->name }}</h2>
        <p>Date: {{ $event->date }}</p>
        <p>Price of Tickets: {{ $event->price_of_tickets }}</p>
        <p>Number of Tickets: {{ $event->number_of_tickets }}</p>
        @if ($event->number_of_tickets > 0)
            {{ $event->name }} - {{ $event->description }}
                <a href="{{ route('events.show', $event->id) }}">More Info</a>
            <form action="{{ route('events.apply', $event) }}" method="post">
                @csrf
                <input type="email" name="email" placeholder="Enter your email">
                <button type="submit">Apply</button>
            </form>
        @else
            <p>No more tickets available for this event.</p>
        @endif
    </div>
    @endforeach
    @else
        <p>No events available.</p>
    @endif
    </div>
@endsection

