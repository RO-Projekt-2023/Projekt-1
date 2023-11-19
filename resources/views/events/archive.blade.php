<!-- resources/views/events/archive.blade.php -->


@extends('navbar')


@section('content')
    <div class="events-container" style="margin-top: 60px;">
    <h1>Archived Events</h1>

    @if(count($inactiveEvents) > 0)
        @foreach($inactiveEvents as $event)
            <h2>{{ $event->name }}</h2>
            <p>Description: {{ $event->description }}</p>
            <p>Date: {{ $event->date }}</p>
            <p>Price of Tickets: {{ $event->price_of_tickets }}</p>
        @endforeach
    @else
        <p>No archived events available.</p>
    @endif
    </div>
@endsection
