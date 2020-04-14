<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Events\StatusCreated;
use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_users_cannot_create_statuses()
    {
        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi primer estado']);

        $response->assertStatus(401);
    }

    /** @test  */
    public function an_authenticated_user_can_create_statuses()
    {
        Event::fake([StatusCreated::class]);

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), [
            'body' => 'Mi primer estado'
        ]);

        Event::assertDispatched(StatusCreated::class, function ($e) {
            return $e->status->id === Status::first()->id
                && get_class($e->status) === StatusResource::class;
        });

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
            'message' ,'errors' => ['body']
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
