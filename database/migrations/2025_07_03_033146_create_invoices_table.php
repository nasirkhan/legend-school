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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('invoice_type');    //1=One time, 2=Annual, 3=Monthly, 4=Any Time
            $table->integer('reference_id')->nullable();    //Item Id.
            $table->string('invoice_no');
            $table->year('year');
            $table->integer('class_id');
            $table->integer('student_id');
            $table->float('actual_amount', 8, 2);
            $table->float('discount_amount', 8, 2)->default(0);
            $table->float('receivable_amount', 8, 2);
            $table->date('deadline')->nullable();
            $table->date('payment_date')->nullable();
            $table->tinyInteger('status')->default(2); //1=Paid, 2=Unpaid, 3=Deleted
            $table->tinyInteger('creator_id');
            $table->tinyInteger('updater_id');
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
        Schema::dropIfExists('invoices');
    }
};
