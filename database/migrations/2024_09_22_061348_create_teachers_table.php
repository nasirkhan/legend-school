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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('designation_id');
            $table->string('mobile');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('passport')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('sl')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('creator_id');
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
        Schema::dropIfExists('teachers');
    }
};
