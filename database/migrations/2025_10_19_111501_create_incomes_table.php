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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->year('year')->nullable();
            $table->integer('item_id')->nullable(); //Expense Item Table ID
            $table->tinyInteger('month_id')->nullable();
            $table->integer('account_id')->nullable();  //From Beneficiary Table
            $table->string('bearer')->nullable();
            $table->string('contact_no')->nullable();
            $table->float('amount',10,2);
            $table->tinyInteger('payment_method')->default(1); //1 = Cash, 2 = Bank
            $table->string('reference')->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('creator_id');
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
        Schema::dropIfExists('incomes');
    }
};
