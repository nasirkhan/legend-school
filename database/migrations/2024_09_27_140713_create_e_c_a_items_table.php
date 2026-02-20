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
        Schema::create('e_c_a_items', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('eca_type_id');
            $table->string('name');
            $table->tinyText('code')->nullable();
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
        Schema::dropIfExists('e_c_a_items');
    }
};
