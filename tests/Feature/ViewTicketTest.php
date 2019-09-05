<?php

namespace Tests\Feature;

use App\Group;
use App\Ticket;
use App\User;
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
        $ticket = create(Ticket::class, ['user_id' => create(User::class)->id]);

        $this->signIn()
            ->get('tickets/' . $ticket->id)
            ->assertStatus(403);
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

    /** @test */
    public function a_staff_member_can_view_a_ticket_assigned_to_their_group()
    {
        $group = create(Group::class);
        $this->signInStaff($group->id);

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'group_id' => $group->id
        ]);

        $this->get('tickets/' . $ticket->id)
            ->assertViewHas('ticket', $ticket);
    }
}
