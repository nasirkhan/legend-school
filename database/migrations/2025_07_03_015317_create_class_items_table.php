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
        Schema::create('class_items', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->tinyInteger('class_id');
            $table->integer('item_id');
            $table->float('amount',10,2)->nullable();
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
        Schema::dropIfExists('class_items');
    }
};
