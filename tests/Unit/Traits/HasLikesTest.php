<?php

namespace Tests\Unit\Traits;

use App\User;
use Tests\TestCase;
use App\Models\Like;
use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasLikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_model_morph_many_likes()
    {
        $model = new ModelWithLikes(['id' => 1]);

        factory(Like::class)->create([
            'likeable_id' => $model->id,          // 1
            'likeable_type' => get_class($model)  // App\Models\Comment
        ]);

        $this->assertInstanceOf(Like::class, $model->likes->first());
    }

    /** @test */
    function a_model_can_be_liked_and_unliked()
    {
        $model = new ModelWithLikes(['id' => 1]);

        $this->actingAs(factory(User::class)->create());

        $model->like();

        $this->assertEquals(1, $model->likes()->count());

        $model->unlike();

        $this->assertEquals(0, $model->likes()->count());
    }

    /** @test */
    function a_model_can_be_liked_once()
    {
        $model = new ModelWithLikes(['id' => 1]);

        $this->actingAs(factory(User::class)->create());

        $model->like();

        $this->assertEquals(1, $model->likes()->count());

        $model->like();

        $this->assertEquals(1, $model->likes()->count());
    }

    /** @test */
    function a_model_knows_if_it_has_been_liked()
    {
        $model = new ModelWithLikes(['id' => 1]);

        $this->assertFalse($model->isLiked());

        $this->actingAs(factory(User::class)->create());

        $this->assertFalse($model->isLiked());

        $model->like();

        $this->assertTrue($model->isLiked());
    }

    /** @test */
    function a_model_knows_how_many_likes_it_has()
    {
        $model = new ModelWithLikes(['id' => 1]);

        $this->assertEquals(0, $model->likesCount());

        factory(Like::class, 2)->create([
            'likeable_id' => $model->id,          // 1
            'likeable_type' => get_class($model)  // App\Models\ModelWithLikes
        ]);

        $this->assertEquals(2, $model->likesCount());
    }
}

class ModelWithLikes extends Model
{
    use HasLikes;

    protected $fillable = ['id'];
}
