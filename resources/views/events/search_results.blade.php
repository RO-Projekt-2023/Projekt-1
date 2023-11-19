<!-- events/search_results.blade.php -->

@extends('navbar')


@section('content')
    <div class="events-container" style="margin-top: 60px;">
    <form action="{{ route('events.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search events...">
        <button type="submit">Search</button>
    </form>
    @if(count($events) > 0)
        <h1>Search Results for "{{ $searchQuery }}"</h1>
            @foreach($events as $event)
            <div>
                <h2>{{ $event->name }}</h2>
                <p>Description: {{ $event->description }}</p>
                <p>Date: {{ $event->date }}</p>
                <p>Price of Tickets: {{ $event->price_of_tickets }}</p>
                <p>Number of Tickets: {{ $event->number_of_tickets }}</p>
                @if ($event->number_of_tickets > 0)
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
        <p>No events found for "{{ $searchQuery }}".</p>
    @endif

    </div>
@endsection

