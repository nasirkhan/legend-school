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
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->date('due_date');
            $table->date('payment_date');
            $table->integer('late_fee');
            $table->integer('delay');
            $table->integer('amount');
            $table->integer('discount')->default(0);
            $table->integer('received');
            $table->string('note')->default('Late Fee');
            $table->string('attachment')->nullable();
            $table->string('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fines');
    }
};
