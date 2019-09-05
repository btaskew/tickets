<?php

namespace Tests\Unit;

use App\Group;
use App\StaffUser;
use App\Ticket;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StaffUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_staff_user_belongs_to_a_user()
    {
        $user = create(User::class);
        $staff = create(StaffUser::class, ['user_id' => $user->id]);

        $this->assertTrue($staff->user->is($user));
    }

    /** @test */
    public function a_staff_user_belongs_to_a_group()
    {
        $group = create(Group::class);
        $user = create(StaffUser::class, ['group_id' => $group->id]);

        $this->assertTrue($user->group->is($group));
    }

    /** @test */
    public function a_staff_user_has_assigned_tickets()
    {
        $user = create(StaffUser::class);
        $ticket = create(Ticket::class, ['assignee_id' => $user->id]);

        $this->assertTrue($user->assignedTickets->contains($ticket));
    }
}
