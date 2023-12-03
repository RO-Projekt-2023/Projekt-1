<!-- resources/views/events/archive.blade.php -->


@extends('navbar')


@section('content')
    <div class="content-container" style="margin-top: 30px;">
    <h1>Archived Events</h1><br>
    <div class="more">
    <p>Did you happen to miss out on some exceptional shows? Now's your chance to catch up on the ones that are currently available! Dive into a world of entertainment and rediscover the magic of events you might have overlooked. Don't let the excitement pass you by – explore the latest shows and experiences that await you!</p>
    <a class="link" aria-current="page" href="/">Check More</a>
</div>
</div>
<div class="content-container2" style="margin-top: 30px;">
<br>
<div class="about-us">
    <p>Curious to know more about us? Discover the story behind the scenes and the passion that fuels our events. From our humble beginnings to the vibrant community we've built, the 'About Us' section is your gateway to understanding the heart and soul of our organization. Take a journey with us and learn about the people, the vision, and the dedication that make every event special.</p>
    <a class="link" aria-current="page" href="/">Learn More</a>
</div><br>
</div>
<div class="item-container"> 
    @if(count($inactiveEvents) > 0)
        @foreach($inactiveEvents as $event)
        <div class="event-v2">

            <p class="name">{{ $event->name }}</p>
            <b>Description:</b> {{ $event->description }} <br>
            <b>Date:</b> {{ $event->date }} <br>
            <b>Location:</b> {{ $event->date }} <br> 
            <b>Price of Tickets:</b>  {{ $event->price_of_tickets }}€
</div>
        @endforeach
    @else
        <p>No archived events available.</p>
    @endif


    </div>
@endsection
