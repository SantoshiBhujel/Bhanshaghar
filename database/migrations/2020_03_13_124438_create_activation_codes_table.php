<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('activation_codes')) 
        {
            Schema::create('activation_codes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('users_id')->index();
                //$table->integer('users_id')->unsigned()->index();
                $table->string('code');
                $table->timestamps();
                $table->foreign('users_id')->references('id')->on('users')->softDelete('cascade');
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
        Schema::dropIfExists('activation_codes');
    }
}
