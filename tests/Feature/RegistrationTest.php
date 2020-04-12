<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_register()
    {
        $response = $this->post(route('register'), $this->userValidData());

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

    /** @test */
    function the_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => null])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => 123])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => Str::random(61)])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => '12'])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_name_must_be_unique()
    {
        factory(User::class)->create(['name' => 'LuisParrado']);

        $this->post(
            route('register'),
            $this->userValidData(['name' => 'LuisParrado'])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_name_may_only_content_letters_and_numbers()
    {
        $this->post(
            route('register'),
            $this->userValidData(['name' => 'LuisParrado2*'])
        )->assertSessionHasErrors('name');

        $this->post(
            route('register'),
            $this->userValidData(['name' => 'Luis Parrado'])
        )->assertSessionHasErrors('name');
    }

    /** @test */
    function the_first_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => null])
        )->assertSessionHasErrors('first_name');
    }

    /** @test */
    function the_first_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => 123])
        )->assertSessionHasErrors('first_name');
    }

    /** @test */
    function the_first_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => Str::random(61)])
        )->assertSessionHasErrors('first_name');
    }

    /** @test */
    function the_first_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => '12'])
        )->assertSessionHasErrors('first_name');
    }

    /** @test */
    function the_first_name_may_only_content_letters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => 'Luis2*'])
        )->assertSessionHasErrors('first_name');

        $this->post(
            route('register'),
            $this->userValidData(['first_name' => 'Luis P'])
        )->assertSessionHasErrors('first_name');
    }

    /** @test */
    function the_last_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => null])
        )->assertSessionHasErrors('last_name');
    }

    /** @test */
    function the_last_name_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => 123])
        )->assertSessionHasErrors('last_name');
    }

    /** @test */
    function the_last_name_may_not_be_greater_than_60_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => Str::random(61)])
        )->assertSessionHasErrors('last_name');
    }

    /** @test */
    function the_last_name_must_be_at_least_3_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => '12'])
        )->assertSessionHasErrors('last_name');
    }

    /** @test */
    function the_last_name_may_only_content_letters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => 'Parrado 56'])
        )->assertSessionHasErrors('last_name');

        $this->post(
            route('register'),
            $this->userValidData(['last_name' => 'Luis-*P'])
        )->assertSessionHasErrors('last_name');
    }

    /** @test */
    function the_email_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['email' => null])
        )->assertSessionHasErrors('email');
    }

    /** @test */
    function the_email_must_be_valid()
    {
        $this->post(
            route('register'),
            $this->userValidData(['email' => 'invalid-email'])
        )->assertSessionHasErrors('email');
    }

    /** @test */
    function the_email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'luisprmat@mail.com']);

        $this->post(
            route('register'),
            $this->userValidData(['email' => 'luisprmat@mail.com'])
        )->assertSessionHasErrors('email');
    }

    /** @test */
    function the_password_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => null])
        )->assertSessionHasErrors('password');
    }

    /** @test */
    function the_password_must_be_a_string()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => 123])
        )->assertSessionHasErrors('password');
    }

    /** @test */
    function the_password_must_be_at_least_8_characters()
    {
        $this->post(
            route('register'),
            $this->userValidData(['password' => '1234567'])
        )->assertSessionHasErrors('password');
    }

    /** @test */
    function the_password_must_be_confirmed()
    {
        $this->post(
            route('register'),
            $this->userValidData([
                'password' => '12345678',
                'password_confirmation' => null
            ])
        )->assertSessionHasErrors('password');
    }

    protected function userValidData($overrides = []): array
    {
        return array_merge([
            'name' => 'LuisParrado',
            'first_name' => 'Luis',
            'last_name' => 'Parrado',
            'email' => 'luisprmat@mail.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ], $overrides);
    }
}
