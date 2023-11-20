<?php

namespace App\Http\Controllers;

use App\Models\Events; // Make sure this import points to the correct namespace

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Add this line for the Mail facade
use Illuminate\Support\Facades\Redirect;



class EventController extends Controller
{
    public function index()
    {
        $events = Events::where('isActive', true)->get();
        return view('events.index', compact('events'));
    }

    public function archive()
    {
        $inactiveEvents = Events::where('isActive', false)->get();
        return view('events.archive', compact('inactiveEvents'));
    }

    public function show(Events $event)
    {
        return view('events.show', compact('event'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $events = Events::where('isActive', true)
                        ->where(function ($query) use ($searchQuery) {
                            $query->where('name', 'like', '%' . $searchQuery . '%')
                                ->orWhere('description', 'like', '%' . $searchQuery . '%');
                            // Add more conditions for other searchable fields if needed
                        })
                        ->get();

        return view('events.search_results', compact('events', 'searchQuery'));
    }

    public function apply(Request $request, Events $event)
    {
        if ($event->number_of_tickets > 0) {
            $email = $request->input('email');
            $ticketCode = mt_rand(100000, 999999); // Generate a random 6-digit code

            $ticket = Tickets::create([
                'code' => $ticketCode,
                'email' => $email,
                'status' => 0,
                'event_id' => $event->id,
            ]);

            $event->decrement('number_of_tickets');

            $data = [
                'ticketCode' => $ticketCode,
                'createdAt' => $ticket->created_at,
                'price' => $event->price_of_tickets, // Assuming you have a price column in the events table
            ];

            Mail::send('emails.ticket', $data, function ($message) use ($email) {
                $message->to($email)->subject('Ticket Details');
            });

            return Redirect::route('events.index')->with('success', 'Ticket purchase successful!');

        } else {
            return redirect()->back()->with('error', 'No more tickets available for this event!');
        }
    }
}
