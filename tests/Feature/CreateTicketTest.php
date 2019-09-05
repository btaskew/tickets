<?php

namespace Tests\Feature;

use App\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTicketTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_ticket()
    {
        $group = create(Group::class);

        $this->signIn()
            ->post('tickets', [
                'title' => 'New ticket',
                'body' => 'My test ticket',
                'group' => $group->id
            ])
            ->assertRedirect('/tickets/1');

        $this->assertDatabaseHas('tickets', [
            'title' => 'New ticket',
            'body' => 'My test ticket',
            'user_id' => 1,
            'group_id' => $group->id
        ]);
    }
}
