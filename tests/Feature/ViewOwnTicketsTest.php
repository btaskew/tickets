<?php

namespace Tests\Feature;

use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewOwnTicketsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_their_tickets()
    {
        $this->signIn();

        $ticket = create(Ticket::class, ['user_id' => auth()->id()]);

        $response = $this->get('tickets')
            ->assertViewHas('tickets');

        // TODO change this to assert we can see the ticket title once views made
        $this->assertTrue($response->getOriginalContent()->getData()['tickets']->contains($ticket));
    }

    /** @test */
    public function a_user_can_view_one_of_their_tickets()
    {
        $this->signIn();

        $ticket = create(Ticket::class, ['user_id' => auth()->id()]);

        $this->get('tickets/' . $ticket->id)
            ->assertViewHas('ticket', $ticket);
    }

    /** @test */
    public function a_user_cant_view_someone_elses_ticket()
    {
        $ticket = create(Ticket::class, ['user_id' => create(User::class)->id]);

        $this->signIn()
            ->get('tickets/' . $ticket->id)
            ->assertStatus(403);
    }

    /** @test */
    public function a_staff_member_can_view_a_ticket_assigned_to_them()
    {
        // TODO move to new test ViewAssignedTicketsTest
        $this->signInStaff();

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => auth()->id()
        ]);

        $this->get('tickets/' . $ticket->id)
            ->assertViewHas('ticket', $ticket);
    }
}
