<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     */
    public function registered_users_can_login()
    {
        factory(User::class)->create([
            'email' => 'luisprmat@gmail.com'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'luisprmat@gmail.com')
                    ->type('password', 'password')
                    ->press('@login-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated()
            ;
        });
    }

    /** @test */
    function user_cannot_login_with_invalid_information()
    {
        factory(User::class)->create(['email' => 'luis@gmail.com']); //'password' = 'password'

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'luis@gmail.com')
                ->type('password', 'other-password')
                ->press('@login-btn')
                ->assertPathIs('/login')
                ->assertPresent('@validation-errors')
            ;
        });
    }
}
