<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class FilmsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function getAllFilms()
    {
        $genres = (new Genre)->getAllFilms();
        return view('films.films_show', compact('genres'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $genre
     * @return Application|Factory|Response|View
     */
    public function getFilmsByGenre(string $genre)
    {
        $genre = Genre::getFilmsByGenre($genre);

        return view('films.films_for_genre', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $genres = Genre::getGenres();

        return view('films.film_create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            Film::saveFilm($request->except('_token', 'genres'),
                $request->get('genres'));
        } catch (\Exception $exception) {
            return back()->with(['error' => 'Film adding failed']);
        }
        return back()->with(['success' => 'Film added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Film::deleteFilm((int)$id);

        return back();
    }
}