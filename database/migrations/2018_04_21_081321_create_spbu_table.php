<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpbuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spbu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('latitude', 20, 8);
            $table->decimal('longitude', 20, 8);
            $table->text('address')->nullable();
            $table->integer('is_mosque')->default(0);
            $table->integer('is_toilet')->default(0);
            $table->integer('is_brightwash')->default(0);
            $table->integer('is_snack_store')->default(0);
            $table->integer('is_olimart')->default(0);
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
        Schema::dropIfExists('spbu');
    }
}
