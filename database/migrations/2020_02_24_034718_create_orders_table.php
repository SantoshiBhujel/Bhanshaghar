<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('orders')) 
        {
            Schema::create('orders', function (Blueprint $table) 
            {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('users_id')->index();
                $table->foreign('users_id')->references('id')->on('users')->softDelete('cascade');
                $table->date('orderDate');
                $table->dateTime('requiredDate');
                $table->string('billing_email');
                $table->string('billing_name');
                $table->string('billing_address');
                $table->string('billing_city')->nullable();
                $table->string('billing_province')->nullable();
                $table->string('billing_postalcode')->nullable();
                $table->unsignedBigInteger('billing_phone');
                $table->string('billing_name_on_card');
                $table->integer('billing_discount')->default(0);  
                $table->string('billing_discount_code')->nullable();
                $table->integer('billing_subtotal');
                $table->integer('billing_tax');
                $table->integer('billing_total');
                $table->string('payment_gateway')->default('stripe');
                $table->boolean('shipped')->default(false);
                $table->string('error')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
