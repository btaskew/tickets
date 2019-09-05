<?php

namespace Tests\Unit;

use App\Group;
use App\StaffUser;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_group_has_tickets_assigned()
    {
        $group = create(Group::class);
        $ticket = create(Ticket::class, ['group_id' => $group->id]);

        $this->assertTrue($group->tickets->contains($ticket));
    }

    /** @test */
    public function a_group_can_fetch_its_tickets_grouped_by_their_assignee()
    {
        $group = create(Group::class);
        $user = create(User::class);
        $staff = create(StaffUser::class, [
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);

        $assignedTicket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => $staff->id,
            'group_id' => $group->id
        ]);

        $unassignedTicket = create(Ticket::class, [
            'user_id' => create(User::class)->id,
            'assignee_id' => null,
            'group_id' => $group->id
        ]);

       $tickets = $group->getGroupedTickets();

       $this->assertArrayHasKey($user->name, $tickets->toArray());
       $this->assertTrue($tickets[$user->name]->contains($assignedTicket));

       $this->assertArrayHasKey('unassigned', $tickets->toArray());
       $this->assertTrue($tickets['unassigned']->contains($unassignedTicket));
    }
}
