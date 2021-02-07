<?php

use App\Http\Controllers\FilmsController;
`use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => Redirect::to(route('film_create')));

Auth::routes();

Route::prefix('films')->group(function () {
    Route::get('/', [FilmsController::class, 'getAllFilms'])->name('all_films');
    Route::get('/create', [FilmsController::class, 'create'])->name('film_create');
    Route::post('/', [FilmsController::class, 'store'])->name('film_store');
    Route::delete('/{id}', [FilmsController::class, 'destroy'])->name('film_delete');
    Route::get('/edit/{id}', [FilmsController::class, 'edit'])->name('film_edit');
    Route::put('/{id}', [FilmsController::class, 'update'])->name('film_update');
    Route::get('/{genre}', [FilmsController::class, 'getFilmsByGenre'])->name('films_for_genre');
});

Route::prefix('genres')->group(function () {
    Route::get('/', [GenresController::class, 'getAllGenres'])->name('all_genres');
    Route::get('/create', [GenresController::class, 'create'])->name('genre_create');
    Route::post('/', [GenresController::class, 'store'])->name('genre_store');
    Route::delete('/{id}', [GenresController::class, 'destroy'])->name('genre_delete');
    Route::get('/edit/{id}', [GenresController::class, 'edit'])->name('genre_edit');
    Route::put('/{id}', [GenresController::class, 'update'])->name('genre_update');
});

