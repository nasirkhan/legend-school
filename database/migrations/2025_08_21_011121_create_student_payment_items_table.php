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
        Schema::create('student_payment_items', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('month_id')->nullable();
            $table->integer('class_id');
            $table->integer('student_id');
            $table->integer('item_id');
            $table->integer('amount');
            $table->integer('lab_fee')->nullable();
            $table->integer('discount')->default(0);
            $table->integer('late_fee')->default(0);
            $table->integer('receivable');
            $table->date('due_date')->nullable();
            $table->date('second_due_date')->nullable();
            $table->date('payment_date')->nullable();   //Received Date
            $table->integer('payment_id')->nullable();   //Received Date
            $table->tinyInteger('status')->default(2); //1 = received; 2 = due; 3 = upcoming
            $table->string('note')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('student_payment_items');
    }
};
