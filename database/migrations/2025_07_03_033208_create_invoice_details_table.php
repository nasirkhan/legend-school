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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('class_item_id');
            $table->integer('reference_id')->nullable();    //Month Id
            $table->float('actual_amount', 8, 2);
            $table->float('discount_amount', 8, 2)->default(0);
            $table->float('receivable_amount', 8, 2);
            $table->tinyInteger('status')->default(1);  //1=Active, 2=Deleted
            $table->tinyInteger('creator_id');
            $table->tinyInteger('deleter_id')->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
};
