<?php

use App\Http\Controllers\FilmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => Redirect::to(route('film_create')));

Auth::routes();

Route::prefix('film')->group(function () {
    Route::get('/create', [FilmsController::class, 'create'])->name('film_create');
    Route::post('/store', [FilmsController::class, 'store'])->name('film_store');
    Route::post('/delete/{id}', [FilmsController::class, 'destroy'])->name('film_delete');
});

Route::get('/all_films', [FilmsController::class, 'getAllFilms'])
    ->name('all_films');

    Route::get('{genre}/films', [FilmsController::class, 'getFilmsByGenre'])
        ->name('films_for_genre');
