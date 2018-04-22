<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfigurationToSpbuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spbu', function (Blueprint $table) {
            $table->integer('capacity')->default(0);
            $table->time('open_at')->nullable();
            $table->time('closed_at')->nullable();
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
            $table->dropColumn('capacity');
            $table->dropColumn('open_at');
            $table->dropColumn('closed_at');

        });
    }
}
