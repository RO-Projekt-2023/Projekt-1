<?php

namespace Tests\Feature;

require_once __DIR__ . '/../../vendor/autoload.php';


use App\Models\Event;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_a_basic_request(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_events_request(): void
    {
        // Sample data for the event
        $eventData = [
            'name' => 'Stand-up večer',
            'date' => '2024-02-21',
            'price_of_tickets' => 5,
            'number_of_tickets' => 96,
            'location' => 'Klub eMCe',
            'description' => 'Stand-up večer z vašim najljubšim komikom!',
        ];

        // Visit the event show page with a placeholder event ID (e.g., 1)
        $response = $this->get(route('events.show', ['event' => 1]));

        // Assert that the response has a successful status code
        $response->assertStatus(200);        

        // Assert that the event details are displayed correctly on the page
        $response->assertSeeText($eventData['name']);
        $response->assertSeeText($eventData['date']);
        $response->assertSeeText($eventData['location']);
        $response->assertSeeText($eventData['price_of_tickets'] . '€');
        $response->assertSeeText($eventData['number_of_tickets']);
        $response->assertSeeText($eventData['description']);

        // Assert that the ticket application form is present
        $response->assertSeeText('Email:');
        $response->assertSeeText('Če želite dobiti vstopnico za dogodek, spodaj vpišite vaš e-poštni naslov!');

    }

    public function testTicketEmailView()
    {
        // Replace these variables with your actual data
        $ticketCode = '12345';
        $createdAt = now()->format('Y-m-d H:i:s');
        $eventName = 'Sample Event';
        $eventDate = now()->addDays(7)->format('Y-m-d H:i:s');
        $eventLocation = 'Sample Location';
        $price = 20;

        $response = $this->view('emails.ticket', compact(
            'ticketCode',
            'createdAt',
            'eventName',
            'eventDate',
            'eventLocation',
            'price'
        ));


        // Add more specific assertions based on your view content
        // For example, you can check if certain text or variables are present in the rendered view
        $response->assertSeeText('Potrditev nakupa vstopnice');
        $response->assertSeeText('Datum nakupa: ' . $createdAt);
        $response->assertSeeText('Prireditveni dogodek: Sample Event');
        $response->assertSeeText('Datum dogodka: ' . $eventDate);
        $response->assertSeeText('Lokacija: Sample Location');
        $response->assertSeeText('Cena: ' . $price . '€');
    }
}
