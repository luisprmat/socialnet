<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'LuisParrado',
            'first_name' => 'Luis',
            'last_name' => 'Parrado',
            'email' => 'luisprmat@gmail.com'
        ]);

        factory(User::class)->create([
            'name' => 'NataliaManrique',
            'first_name' => 'Natalia',
            'last_name' => 'Manrique',
            'email' => 'natis_andru@hotmail.com'
        ]);
    }
}
