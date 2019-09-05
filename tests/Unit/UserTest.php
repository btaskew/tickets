<?php

namespace Tests\Unit;

use App\StaffUser;
use App\Ticket;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_many_tickets()
    {
        $user = create(User::class);
        $ticket = create(Ticket::class, ['user_id' => $user->id]);

        $this->assertTrue($user->tickets->contains($ticket));
    }

    /** @test */
    public function a_user_knows_if_it_is_a_staff_user()
    {
        $user = create(User::class);

        $this->assertFalse($user->isStaff());

        create(StaffUser::class, ['user_id' => $user]);

        $this->assertTrue($user->isStaff());
    }
}
