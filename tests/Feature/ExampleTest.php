<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testPageLoadsandRedirectsWhenUsertriestoJump()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

    public function testIndexBuyButtonWorks()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

    public function testShippingPaymentButtonWorks()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

    public function testPaymentCheckButtonWorks()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

    //------------//

    public function testcan_user_access_admin_if_logged_out()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

    public function testcan_user_access_admin_if_logged_in()
    {

        $this->assertGuest($guard = null);
        $response = $this->get('/');
        $response->assertStatus(200);

        //Admin Logged in can Access

        //Not logged in cannot access
    }

}
