<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_users_cannot_create_statuses()
    {
        $response = $this->post(route('statuses.store'), ['body' => 'Mi primer estado']);

        $response->assertRedirect('login');
    }

    /** @test  */
    public function an_authenticated_user_can_create_statuses()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), [
            'body' => 'Mi primer estado'
        ]);

        $response->assertJson([
            'data' => ['body' => 'Mi primer estado']
        ]);

        $this->assertDatabaseHas('statuses', [
            'user_id' => $user->id,
            'body' => 'Mi primer estado'
        ]);
    }

    /** @test */
    function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => ['body']
        ]);
    }

    /** @test */
    function a_status_body_requires_a_minimun_length()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'asdf']);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'errors' => ['body']
        ]);
    }
}
