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
        Schema::create('h_w_annotations', function (Blueprint $table) {
            $table->id();
            $table->string('doc_type'); //Home Work OR Class Work etc.
            $table->integer('doc_id');
            $table->integer('page_no');
            $table->string('ann_type');  //Check OR Cross OR Pencil
            $table->longText('annotations');
            $table->string('ann_color');
            $table->string('ann_maker_type');
            $table->string('user_id');
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
        Schema::dropIfExists('h_w_annotations');
    }
};
