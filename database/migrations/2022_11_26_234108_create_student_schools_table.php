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
        Schema::create('student_schools', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->year('year');
            $table->integer('session_id');
            $table->tinyInteger('status')->default(1);
            $table->integer('creator_id')->nullable();
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
        Schema::dropIfExists('student_schools');
    }
};
