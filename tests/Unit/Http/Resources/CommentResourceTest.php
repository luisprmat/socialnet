<?php

namespace Tests\Unit\Http\Resources;

use Tests\TestCase;
use App\Models\Status;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_comment_resource_must_have_the_necessary_fields()
    {
        $comment = factory(Status::class)->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals(
            $comment->body,
            $commentResource['body']
        );
    }
}
