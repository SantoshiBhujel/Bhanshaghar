<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('items')) 
        {
            Schema::create('items', function (Blueprint $table) 
            {
                $table->bigIncrements('id');
                $table->string('name')->unique();
                $table->integer('price');
                $table->unsignedBigInteger('menus_id')->index();
                $table->string('image');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
}
