<?php

namespace Tests;

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
}
