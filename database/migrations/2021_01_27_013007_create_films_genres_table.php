<?php

use App\Film;
use App\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('genre_id');

            $table->foreign('film_id')->references('id')
                ->on('films')->index('films_genres_film_id_foreign');

//            $table->foreign('film_id')->references('id')
//                ->on('films')->onDelete('cascade')
//                ->onUpdate('cascade')->index('films_genres_film_id_foreign');
//            $table->foreign('genre_id')->references('id')
//                ->on('genres')->onDelete('cascade')
//                ->onUpdate('cascade')->index('films_genres_genre_id_foreign');

            $table->foreign('genre_id')->references('id')
                ->on('genres')->index('films_genres_genre_id_foreign');

//            $table->foreignId('film_id')->constrained()
//                ->onDelete('cascade')->onUpdate('cascade')
//                ->index('films_genres_film_id_foreign');
//            $table->foreignId('genre_id')->constrained()
//                ->onDelete('cascade')->onUpdate('cascade')
//                ->index('films_genres_genre_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films_genres');
    }
}
