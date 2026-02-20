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
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->tinyInteger('subject_id');
            $table->string('name');
            $table->tinyText('code')->nullable();
            $table->tinyInteger('mark');
            $table->tinyInteger('weight')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('sl')->nullable();
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
        Schema::dropIfExists('papers');
    }
};
