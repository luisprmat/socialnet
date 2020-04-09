<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\Status;
use App\Http\Resources\StatusResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_status_resource_must_have_the_necessary_fields()
    {
        $status = factory(Status::class)->create();

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals(
            $status->body,
            $statusResource['body']
        );
        $this->assertEquals(
            $status->user->name,
            $statusResource['user_name']
        );
        $this->assertEquals(
            '/images/default-user.png',
            $statusResource['user_avatar']
        );
        $this->assertEquals(
            $status->created_at->diffForHumans(),
            $statusResource['ago']
        );
    }
}
