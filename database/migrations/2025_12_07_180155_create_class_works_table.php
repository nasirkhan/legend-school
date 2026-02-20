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
        Schema::create('class_works', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->integer('teacher_id');
            $table->date('date');
            $table->string('chapter')->nullable();
            $table->text('cw_detail')->nullable();
            $table->string('attachment_url')->nullable();
            $table->tinyInteger('status')->default(2);
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
        Schema::dropIfExists('class_works');
    }
};
