@extends('navbar')

@section('content')








    <div class="events-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('events.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search events..." class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>

<div class="wall"> 
        <h1>Events</h1>
        <p>Here you can see all the events that are available.</p>
    </div>
        @if(count($events) > 0)
            @foreach($events as $event)
                <div class="event">
                    <h2>{{ $event->name }}</h2>
                    <b>Date:</b> {{ $event->date }} <br>
                    <b>Location: </b> <br>
                    <b>Price of Tickets:</b>  {{ $event->price_of_tickets }}<br>
                    <b>Number of Tickets: </b>{{ $event->number_of_tickets }} <br>
                    <a href="{{ route('events.show', $event->id) }}">More Info</a>
                </div>
            @endforeach
        @else
            <b style ="margin-left:3em;">No events available.</b>
        @endif

        
    </div>
@endsection
