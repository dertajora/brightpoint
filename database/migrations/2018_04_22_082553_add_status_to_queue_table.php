<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queue_carwash', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->string('customer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_carwash', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('customer');
        });
    }
}
