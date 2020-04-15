<?php

namespace Tests\Unit\Notifications;

use App\User;
use Tests\TestCase;
use App\Models\Status;
use App\Notifications\NewLikeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NewLikeNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function the_notification_is_stored_in_the_database()
    {
        $statusOwner = factory(User::class)->create();
        $likeSender = factory(User::class)->create();

        $status = factory(Status::class)->create(['user_id' => $statusOwner->id]);

        $status->likes()->create([
            'user_id' => $likeSender->id
        ]);

        $statusOwner->notify(new NewLikeNotification($status, $likeSender));

        $this->assertCount(1, $statusOwner->notifications);

        $notificationData = $statusOwner->notifications->first()->data;

        $this->assertEquals($status->path(), $notificationData['link']);

        $this->assertEquals("Al usurio {$likeSender->name} le gustó tu publicación", $notificationData['message']);
    }
}
