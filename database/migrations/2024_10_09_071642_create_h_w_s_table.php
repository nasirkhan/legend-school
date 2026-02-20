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
        Schema::create('h_w_s', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->tinyInteger('class_id');
            $table->tinyInteger('subject_id');
            $table->string('title')->nullable();
            $table->date('assignment_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->longText('hw_detail')->nullable();
            $table->string('attachment_url')->nullable();
            $table->tinyInteger('status')->default(2);
            $table->string('creator')->nullable();
            $table->string('updater')->nullable();
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
        Schema::dropIfExists('h_w_s');
    }
};
