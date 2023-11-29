<!-- resources/views/events/archive.blade.php -->


@extends('navbar')


@section('content')
    <div class="content-container" style="margin-top: 30px;">
    <div id="header">
    <h1>Archived Events</h1></div>
</div>

<div class="item-container"> 
    @if(count($inactiveEvents) > 0)
        @foreach($inactiveEvents as $event)
        <div class="event-v2">

            <h2>{{ $event->name }}</h2>
            <b>Description:</b> {{ $event->description }} <br>
            <b>Location:</b>  <br>
            <b>Date:</b> {{ $event->date }} <br>
            <b>Price of Tickets:</b>  {{ $event->price_of_tickets }}€
</div>
        @endforeach
    @else
        <p>No archived events available.</p>
    @endif


    </div>
@endsection
