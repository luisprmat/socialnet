<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListStatusesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_statuses()
    {
        // $this->withoutExceptionHandling();

        $status1 = factory(Status::class)->create(['created_at' => now()->subdays(4)]);
        $status2 = factory(Status::class)->create(['created_at' => now()->subdays(3)]);
        $status3 = factory(Status::class)->create(['created_at' => now()->subdays(2)]);
        $status4 = factory(Status::class)->create(['created_at' => now()->subdays(1)]);

        $response = $this->get(route('statuses.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'meta' => ['total' => 4]
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        $this->assertEquals(
            $status4->body,
            $response->json('data.0.body')
        );

        $this->assertEquals(
            $status1->body,
            $response->json('data.3.body')
        );
    }

    /** @test */
    function can_get_statuses_for_a_specific_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $status1 = factory(Status::class)->create(['user_id' => $user->id, 'created_at' => now()->subday()]);
        $status2 = factory(Status::class)->create(['user_id' => $user->id]);

        $otherStatuses = factory(Status::class, 2)->create();

        $response = $this->actingAs($user)
            ->getJson(route('users.statuses.index', $user));

        $response->assertSuccessful();

        $response->assertJson([
            'meta' => ['total' => 2]
        ]);

        $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
        ]);

        $this->assertEquals(
            $status2->body,
            $response->json('data.0.body')
        );
    }
}
