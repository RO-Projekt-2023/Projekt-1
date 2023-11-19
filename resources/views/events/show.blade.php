<!-- events/show.blade.php -->
@extends('navbar')


@section('content')
<div class="events-container" style="margin-top: 60px;">
    <h2>{{ $event->name }}</h2>
    <p>Description: {{ $event->description }}</p>
    <p>Date: {{ $event->date }}</p>
    <p>Price of Tickets: {{ $event->price_of_tickets }}</p>
    <p>Number of Tickets: {{ $event->number_of_tickets }}</p>

    <!-- Display other event details as needed -->

    <!-- Ticket Application Form -->
    <form action="{{ route('events.apply', $event->id) }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Apply for Ticket</button>
    </form>
</div>
@endsection
