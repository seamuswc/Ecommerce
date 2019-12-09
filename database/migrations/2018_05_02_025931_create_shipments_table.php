<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number');
            $table->string('name');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postal')->nullable();
            $table->string('phone')->nullable();
            $table->integer('sent');
            $table->integer('qty');
            $table->string('tracking_number')->nullable();
            $table->integer('carrier_id')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
