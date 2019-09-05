<?php

namespace Tests;

use App\StaffUser;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @return TestCase
     */
    protected function signIn(): TestCase
    {
        return $this->actingAs(create(User::class));
    }

    /**
     * @param int|null $groupId
     * @return TestCase
     */
    protected function signInStaff(?int $groupId = null): TestCase
    {
        $this->signIn();

        create(StaffUser::class, [
            'user_id' => auth()->id(),
            'group_id' => $groupId
        ]);

        return $this;
    }
}
