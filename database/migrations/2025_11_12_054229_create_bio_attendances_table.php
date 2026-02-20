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
        Schema::create('bio_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('device_sn');
            $table->unsignedBigInteger('user_id');
            $table->integer('verify_mode')->nullable();
            $table->integer('att_state')->nullable();
            $table->timestamp('timestamp');
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
        Schema::dropIfExists('bio_attendances');
    }
};
