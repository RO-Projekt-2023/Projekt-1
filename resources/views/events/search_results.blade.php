
@extends('navbar')


@section('content')
    <div class="events-container" style="margin-top: 60px;">
    <form action="{{ route('events.search') }}" method="GET">

        <input type="text" name="query" placeholder="Search events..." class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
    @if(count($events) > 0)
    
    <div class="wall"> 

        <h1>Search Results for "{{ $searchQuery }}"</h1>
</div> 

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
    <div class="wall"> 

        <p>No events found for "{{ $searchQuery }}".</p>
    </div>
        @endif

    </div>
@endsection

