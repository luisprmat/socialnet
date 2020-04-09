<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
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
                    ->press('#login-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated()
            ;
        });
    }
}
