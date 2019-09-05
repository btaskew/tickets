<?php

namespace Tests\Feature;

use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewAssignedTicketsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_staff_member_can_view_all_tickets_assigned_to_them()
    {
        $this->signInStaff();

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => auth()->id()
        ]);

        $response = $this->get('tickets/assigned')
            ->assertViewHas('tickets');

        // TODO change this to assert we can see the ticket title once views made
        $this->assertTrue($response->getOriginalContent()->getData()['tickets']->contains($ticket));
    }

    /** @test */
    public function a_staff_member_can_view_a_ticket_assigned_to_them()
    {
        $this->signInStaff();

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => auth()->id()
        ]);

        $this->get('tickets/' . $ticket->id)
            ->assertViewHas('ticket', $ticket);
    }
}
