<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', 'LuisParrado')
                ->type('first_name', 'Luis')
                ->type('last_name', 'Parrado')
                ->type('email', 'luis@mail.com')
                ->type('password', 'secret01')
                ->type('password_confirmation', 'secret01')
                ->press('@register-btn')
                ->assertPathIs('/')
                ->assertAuthenticated()
            ;
        });
    }

    /** @test */
    function user_cannot_register_with_invalid_information()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->type('name', '1')
                ->type('first_name', 'Luis')
                ->type('last_name', 'Parrado')
                ->type('email', 'luis@mail.com')
                ->type('password', 'secret01')
                ->type('password_confirmation', 'secret01')
                ->press('@register-btn')
                ->assertPathIs('/register')
                ->assertPresent('@validation-errors')
            ;
        });
    }
}
