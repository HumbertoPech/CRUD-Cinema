<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_directors', function (Blueprint $table) {
            $table->unsignedBigInteger('movieId');
            $table->unsignedBigInteger('directorId');
            $table->timestamps();

            $table->foreign('movieId')->references('movieId')->on('movies')->onDelete('cascade');
            $table->foreign('directorId')->references('directorId')->on('film_directors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_directors');
    }
}
