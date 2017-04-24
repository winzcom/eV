<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Entities\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendorRegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function vendorRegistration()
    {
        $this->visit('/register')
             ->type('Wole','name')
             ->type('wol2@gmail.com','email')
             ->type('password','password')
             ->press('register')
             ->assertRedirect('/login');
    }
}
