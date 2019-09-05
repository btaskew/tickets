<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_ticket()
    {
        $this->signIn()
            ->post('tickets', [
                'title' => 'New ticket',
                'body' => 'My test ticket'
            ]);

        $this->assertDatabaseHas('tickets', [
            'title' => 'New ticket',
            'body' => 'My test ticket',
            'user_id' => 1
        ]);
    }
}
