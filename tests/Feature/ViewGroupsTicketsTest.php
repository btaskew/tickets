<?php

namespace Tests\Feature;

use App\Group;
use App\StaffUser;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewGroupsTicketsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_staff_member_can_view_all_tickets_in_their_group()
    {
        $group = create(Group::class);
        $this->signInStaff($group->id);

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'group_id' => $group->id
        ]);

        $response = $this->get('group/' . $group->id . '/tickets')
            ->assertViewHas('tickets');

        // TODO change this to assert we can see the ticket title once views made
        $this->assertTrue($response->getOriginalContent()->getData()['tickets']->first()->contains($ticket));
    }

    /** @test */
    public function a_staff_member_cant_view_tickets_in_another_group()
    {
        $group = create(Group::class);
        $otherGroup = create(Group::class);
        $this->signInStaff($group->id);

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'group_id' => $otherGroup->id
        ]);

        $response = $this->get('group/' . $group->id . '/tickets');

        // TODO change this to assert we can see the ticket title once views made
        $this->assertFalse($response->getOriginalContent()->getData()['tickets']->contains($ticket));
    }

    /** @test */
    public function non_staff_members_cant_view_tickets_in_a_group()
    {
        $group = create(Group::class);

        $this->signIn()
            ->get('group/' . $group->id . '/tickets')
            ->assertStatus(403);
    }

    /** @test */
    public function a_staff_member_can_view_a_ticket_assigned_to_their_group()
    {
        $group = create(Group::class);
        $this->signInStaff($group->id);

        $ticket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => create(StaffUser::class)->id,
            'group_id' => $group->id
        ]);

        $this->get('tickets/' . $ticket->id)
            ->assertViewHas('ticket', $ticket);
    }
}
