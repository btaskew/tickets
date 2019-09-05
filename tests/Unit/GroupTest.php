<?php

namespace Tests\Unit;

use App\Group;
use App\Ticket;
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
}
