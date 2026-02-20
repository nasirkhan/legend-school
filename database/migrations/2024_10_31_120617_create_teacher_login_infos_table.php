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
        Schema::create('teacher_login_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->string('mobile');
            $table->string('email');
            $table->string('password');
            $table->tinyInteger('login_status')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->dateTime('last_login_time')->nullable();
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
        Schema::dropIfExists('teacher_login_infos');
    }
};
