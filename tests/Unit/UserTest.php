<?php

namespace Tests\Unit;

use App\StaffUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_knows_if_it_is_a_staff_user()
    {
        $user = create(User::class);

        $this->assertFalse($user->isStaff());

        create(StaffUser::class, ['user_id' => $user]);

        $this->assertTrue($user->isStaff());
    }
}
