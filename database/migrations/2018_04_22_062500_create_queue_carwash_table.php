<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueueCarwashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_carwash', function (Blueprint $table) {
            $table->increments('id');
            $table->date('queue_date');
            $table->smallInteger('source');
            $table->integer('user_id')->nullable();
            $table->integer('queue_no');
            $table->integer('spbu_id');
            $table->integer('created_by');
            $table->integer('updated_by')->default(0);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('queue_carwash');
    }
}
