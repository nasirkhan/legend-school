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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nick_name')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('photo_id')->nullable();
            $table->string('email')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_mobile')->nullable();
            $table->string('address')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_mobile')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('join_date')->nullable();
            $table->integer('monthly_fee')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('monthly_payable')->default(0);
            $table->string('roll')->nullable();
            $table->string('password')->nullable();
            $table->string('passport')->nullable();
            $table->tinyInteger('status')->default(2);
            $table->integer('creator_id')->nullable();  //Approved By
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
        Schema::dropIfExists('students');
    }
};
