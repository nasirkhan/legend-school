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
        Schema::create('previous_dues', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('student_id');
            $table->string('description')->nullable();
            $table->integer('amount');
            $table->integer('discount')->default(0);
            $table->integer('receivable');
            $table->string('note')->nullable();
            $table->tinyInteger('status')->default(2);
            $table->string('creator')->nullable();
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
        Schema::dropIfExists('previous_dues');
    }
};
