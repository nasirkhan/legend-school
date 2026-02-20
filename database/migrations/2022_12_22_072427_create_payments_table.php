<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->tinyInteger('payment_type'); //1=Received, 2=Paid
            $table->float('amount', 8, 2);
            $table->tinyInteger('payment_method')->default(1); //1=Cash, 2=Mobile Bank, 3=Bank
            $table->integer('bank_transaction_id')->nullable();//Applicable if payment method is 2 or 3
            $table->date('payment_date');
            $table->integer('creator_id');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('payments');
    }
};
