<?php

use App\User;
use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::first();
        $user2 = User::find(2);

        factory(Status::class, 3)->create([
            'user_id' => $user1->id
        ]);

        factory(Status::class, 2)->create([
            'user_id' => $user2->id
        ]);

        factory(Status::class)->times(5)->create();
    }
}
