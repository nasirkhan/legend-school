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
        Schema::create('e_c_a_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->tinyInteger('eca_item_id');
            $table->integer('student_id');
            $table->tinyText('grade');
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
        Schema::dropIfExists('e_c_a_activities');
    }
};
