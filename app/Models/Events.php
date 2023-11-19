<?php
namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use CrudTrait;

    protected $table = 'events';
    protected $guarded = ['id'];

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    public function tickets()
    {
        return $this->hasMany(Tickets::class); // Assuming you have a Tickets model
    }

    public function hasAvailableTickets()
    {
        return $this->number_of_tickets > 0;
    }

    public function applyForTicket($email)
    {
        if ($this->hasAvailableTickets()) {
            $ticketCode = uniqid(); // Generate a unique ticket code
            
            $ticket = $this->tickets()->create([
                'code' => $ticketCode,
                'email' => $email,
                'status' => 0, // Assuming status 0 means pending or not used
            ]);

            $this->decrement('number_of_tickets');

            // Send email with ticket code to $email (Implement your email sending logic here)

            return $ticket;
        }
        
        return null; // No more tickets available for this event
    }
}
