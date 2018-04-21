<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOperatorIdToSpbu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spbu', function (Blueprint $table) {
            $table->integer('operator_id')->default(0);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spbu', function (Blueprint $table) {
            $table->dropColumn('operator_id');
        });
    }
}
