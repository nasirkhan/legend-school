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
        Schema::create('private_students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->year('year');
            $table->string('candidate_no');
            $table->date('date_of_birth');
            $table->date('date_of_admission');
            $table->date('date_of_graduation');
            $table->string('nationality');
            $table->string('passport')->nullable();
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
        Schema::dropIfExists('private_students');
    }
};
