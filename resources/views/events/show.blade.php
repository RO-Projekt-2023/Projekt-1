<!-- events/show.blade.php -->
@extends('navbar')


@section('content')
<div class="events-container" style="margin-top: 60px;">
    <h2>{{ $event->name }}</h2>

    <div id="info">
        <h4>Date:</h4>
        <p>{{ $event->date }}</p>
        <h4>Price of Tickets:</h4>
        <p>{{ $event->price_of_tickets }}€</p>
        <h4>Number of Tickets:</h4>
        <p>{{ $event->number_of_tickets }}</p>
    </div>
    <div id="desc">
        <h4>Description:</h4>
        <p>{{ $event->description }}</p>
    </div>
    <!-- Display other event details as needed -->

    <!-- Ticket Application Form -->
    <div id="f">
        <form action="{{ route('events.apply', $event->id) }}" method="POST">
            @csrf
            <h4><label for="email">Email:</label></h4>
            <p>Če želite dobiti vstopnico za dogodek, spodaj vpišite vaš e-poštni naslov!</p>
            <input type="email" id="email" name="email" required>
            <button type="submit">Apply for Ticket</button>
        </form>
    </div>
</div>
@endsection