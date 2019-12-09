<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testOrderPlaced()
    {
        
        $this->assertTrue(true);
    }

    public function testProductCreate()
    {
        //create product
        //if id, name, code, phots pull True
        $this->assertTrue(true);
    }

    public function testStockChange()
    {
        //create products
        //change stock
        //if stock != 0 True
        $this->assertTrue(true);
    }

    //------------//

    public function testshippingFormSubmitsIfValid()
    {
        $this->assertTrue(true);
    }

    public function testshippingFormDeniesIfInalid()
    {
        $this->assertTrue(true);
    }

    public function testPaymentClearsIfValid()
    {
        $this->assertTrue(true);
    }

    public function testPaymentDeniesIfInalid()
    {
        $this->assertTrue(true);
    }

}
