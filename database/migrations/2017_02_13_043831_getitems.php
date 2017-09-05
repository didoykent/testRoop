<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Getitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('items', function(Blueprint $table){

        $table->increments('id');
        $table->string('itemName');
        $table->decimal('itemSrp');
        $table->integer('itemQuantity');
        $table->decimal('totalPrice')->nullable();
        $table->integer('totalQuantity')->nullable();
        $table->integer('totalItems')->nullable();
        $table->decimal('itemDiscount')->nullable();
        $table->decimal('itemTotalDiscount')->nullable();
        $table->decimal('itemOriginalPrice')->nullable();
        $table->decimal('itemClientPrice')->nullable();
        $table->string('itemImagePath')->nullable();
        $table->string('itemCategory')->nullable();
        $table->decimal('itemDealerPrice')->nullable();
        $table->decimal('itemAgentPrice')->nullable();
        $table->string('itemClientName')->nullable();
        $table->integer('itemTempQ')->default(1);
        $table->boolean('itemSaleStatus')->default(false);
        $table->boolean('itemOnSale')->default(false);
        $table->string('itemStatus')->default('active');
        $table->boolean('active')->default(false);
        $table->string('action')->nullable();
        $table->rememberToken();
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
        Schema::drop('items');
    }
}
