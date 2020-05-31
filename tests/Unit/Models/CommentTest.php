<?php

namespace Tests\Unit\Models;

use App\User;
use Tests\TestCase;
use App\Models\Status;
use App\Models\Comment;
use App\Traits\HasLikes;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_comment_belongs_to_a_user()
    {
        $comment = factory(Comment::class)->create();

        $this->assertInstanceOf(User::class, $comment->user);
    }

    /** @test */
    function a_comment_belongs_to_a_status()
    {
        $comment = factory(Comment::class)->create();

        $this->assertInstanceOf(Status::class, $comment->status);
    }

    /** @test */
    function a_comment_model_must_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikes::class, Comment::class);
    }

    /** @test */
    function a_comment_must_have_a_path()
    {
        $comment = factory(Comment::class)->create();
        // statuses/1#comment-1

        $this->assertEquals(route('statuses.show', $comment->status_id) . '#comment-' . $comment->id, $comment->path());
    }

}
