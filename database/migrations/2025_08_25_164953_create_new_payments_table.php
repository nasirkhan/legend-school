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
        Schema::create('new_payments', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->integer('student_id');
            $table->integer('class_id');
            $table->float('amount', 10, 2);
            $table->float('discount', 10, 2)->default(0);
            $table->string('note')->nullable();
            $table->float('received', 10, 2);
            $table->tinyInteger('status')->default(1);
            $table->string('created_by');
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
        Schema::dropIfExists('new_payments');
    }
};
