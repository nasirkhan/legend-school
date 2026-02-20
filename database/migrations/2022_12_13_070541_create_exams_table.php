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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->tinyInteger('session_id')->nullable();
            $table->tinyInteger('section_id');
            $table->tinyInteger('class_id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->integer('sl');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('input_status')->default(2);
            $table->tinyInteger('publication_status')->default(2);
            $table->tinyText('result_type')->nullable();
            $table->tinyText('hw_mark')->default('m');  // m = Manual, a = Auto
            $table->tinyText('cw_mark')->default('m');  // m = Manual, a = Auto
            $table->tinyText('comment')->default('y');  // y = Yes, n = Not
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
        Schema::dropIfExists('exams');
    }
};
