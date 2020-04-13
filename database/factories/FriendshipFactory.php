<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Friendship;
use App\User;
use Faker\Generator as Faker;

$factory->define(Friendship::class, function (Faker $faker) {
    return [
        'recipient_id' => factory(User::class)->create()->id,
        'sender_id' => factory(User::class)->create()->id
    ];
});
