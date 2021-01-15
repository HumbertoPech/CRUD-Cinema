<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            //$table->id();
            $table->bigIncrements('movieId');
            $table->string('name');
            $table->string('synopsis')->nullable();
            $table->string('country', 25)->nullable();
            //$table->string('movieDirector');
            $table->date('release')->nullable();
            $table->time('duration')->nullable();
            $table->string('imageRoute')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
