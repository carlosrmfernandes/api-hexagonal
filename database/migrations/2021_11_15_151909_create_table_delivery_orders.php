<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDeliveryOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');            
            $table->integer('status')->nullable(); // 0 => Pending 1 => Received
            $table->string('cep')->nullable();                        
            $table->string('neighborhood')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('complement')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('consumer_id');
            $table->foreign('consumer_id')->references('id')->on('users');
            $table->unsignedBigInteger('seller_id');
            $table->integer('id_mch')->nullable();
            $table->foreign('seller_id')->references('id')->on('users');
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
        Schema::dropIfExists('delivery_orders');
    }
}
