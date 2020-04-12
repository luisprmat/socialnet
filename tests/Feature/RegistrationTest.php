<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_register()
    {
        $userData = [
            'name' => 'LuisParrado',
            'first_name' => 'Luis',
            'last_name' => 'Parrado',
            'email' => 'luisprmat@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'LuisParrado',
            'first_name' => 'Luis',
            'last_name' => 'Parrado',
            'email' => 'luisprmat@mail.com',
        ]);

        $this->assertTrue(
            Hash::check('password', User::first()->password),
            'The password needs to be hashed'
        );
    }
}
