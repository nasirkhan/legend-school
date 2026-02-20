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
        Schema::create('other_attendances', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('session_id');
            $table->integer('class_id');
            $table->integer('batch_id');
            $table->integer('student_id');
            $table->date('date')->nullable();
            $table->string('table');
            $table->integer('row_id');
            $table->integer('reference_id')->nullable(); //i.e. payment_id or something like that
            $table->tinyInteger('status');  //1 = Present; 2 = Absent;
            $table->integer('creator_id');
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
        Schema::dropIfExists('other_attendances');
    }
};
