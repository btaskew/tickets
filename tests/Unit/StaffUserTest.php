<?php

namespace Tests\Unit;

use App\Group;
use App\StaffUser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class StaffUserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_staff_user_belongs_to_a_group()
    {
        $group = create(Group::class);
        $user = create(StaffUser::class, ['group_id' => $group->id]);

        $this->assertTrue($user->group->is($group));
    }
}
