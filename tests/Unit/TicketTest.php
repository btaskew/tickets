<?php

namespace Tests\Unit;

use App\Group;
use App\StaffUser;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_ticket_belongs_to_a_user()
    {
        $user = create(User::class);
        $ticket = create(Ticket::class, ['user_id' => $user->id]);

        $this->assertTrue($ticket->owner->is($user));
    }

    /** @test */
    public function a_ticket_belongs_to_an_assigned_group()
    {
        $group = create(Group::class);
        $ticket = create(Ticket::class, ['group_id' => $group->id]);

        $this->assertTrue($ticket->group->is($group));
    }

    /** @test */
    public function a_ticket_belongs_to_an_assigned_staff_user()
    {
        $staff = create(StaffUser::class);
        $ticket = create(Ticket::class, ['assignee_id' => $staff->id]);

        $this->assertTrue($ticket->assignee->is($staff));
    }
}
