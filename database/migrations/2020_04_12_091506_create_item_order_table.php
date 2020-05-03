<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('item_order')) 
        {
            Schema::create('item_order', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('order_id')->index();
                $table->foreign('order_id')->references('id')->on('orders')->softDelete('cascade');
                $table->unsignedBigInteger('item_id')->index();
                $table->foreign('item_id')->references('id')->on('items')->softDelete('cascade');
                $table->integer('quantity')->unsigned();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_order');
    }
}
