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
        Schema::table('result_metas', function (Blueprint $table) {
            $table->tinyInteger('promo_status')->after('student_id')->nullable();
            $table->tinyInteger('promoted_class_id')->after('promo_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result_metas', function (Blueprint $table) {
            $table->dropColumn('promo_status','promoted_class_id');
        });
    }
};
