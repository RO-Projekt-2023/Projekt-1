<?php

namespace App\Http\Controllers;

use App\Models\Events; // Make sure this import points to the correct namespace

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Add this line for the Mail facade


class EventController extends Controller
{
    public function index()
    {
        $events = Events::where('isActive', true)->get();
        return view('events.index', compact('events'));
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

            return redirect()->back()->with('success', 'Ticket applied successfully!');
            // Send email with ticket code to $email (Implement your email sending logic here)

        } else {
            return redirect()->back()->with('error', 'No more tickets available for this event!');
        }
    }
}
