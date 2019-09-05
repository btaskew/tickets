<?php

namespace Tests\Feature;

use App\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTicketTest extends TestCase
{
    use RefreshDatabase;

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
        $ticket = create(Ticket::class, ['user_id' => 999]);

        $this->signIn()
            ->get('tickets/' . $ticket->id)
            ->assertStatus(403);
    }
}
