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
        Schema::create('student_h_w_s', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('hw_id');
            $table->string('hw_url');
            $table->tinyInteger('status')->default(2);  //1=checked     2=just uploaded
            $table->string('checked_by')->nullable();
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
        Schema::dropIfExists('student_h_w_s');
    }
};
