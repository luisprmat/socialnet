<?php

namespace Tests\Unit\Listeners;

use App\User;
use Tests\TestCase;
use App\Models\Status;
use App\Events\ModelLiked;
use App\Notifications\NewLikeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendNewLikeNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_notification_is_sent_when_a_user_received_a_new_like()
    {
        Notification::fake();

        $statusOwner = factory(User::class)->create();
        $likeSender = factory(User::class)->create();

        $status = factory(Status::class)->create(['user_id' => $statusOwner->id]);

        $status->likes()->create([
            'user_id' => $likeSender->id
        ]);

        ModelLiked::dispatch($status, $likeSender);

        Notification::assertSentTo(
            $statusOwner,
            NewLikeNotification::class,
            function ($notification, $channels) use ($likeSender, $status) {
                $this->assertContains('database', $channels);
                $this->assertTrue($notification->likeSender->is($likeSender));
                $this->assertTrue($notification->model->is($status));
                return true;
            }
        );

        // [['link' => 'model', 'message' => 'Al usuario Jorge le gusta tu model']]
    }
}
