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
        Schema::create('transcript_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->tinyText('grade'); //Class
            $table->tinyText('exam');
            $table->integer('subject_id');
            $table->float('mark',8,2);
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
        Schema::dropIfExists('transcript_marks');
    }
};
