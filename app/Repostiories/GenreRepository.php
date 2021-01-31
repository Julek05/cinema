<?php

namespace App\Repostiories;

use App\Contracts\GenreRepositoryInterface;
use App\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreRepository implements GenreRepositoryInterface
{
    private Genre $model;

    public function __construct(Genre $model)
    {
        $this->model = $model;
    }

    public function getGenres(): Collection
    {
        return $this->model->select('id', 'name')
            ->where('active', ACTIVE)
            ->orderBy('order')
            ->get();
    }

    public function getFilmsByGenre(string $genre): Genre
    {
        return $this->model->where('name', $genre)
            ->with(['films' => function($query) {
                $query->orderByDesc('id');
            }])
            ->firstOrFail();
    }

    public function getAllFilms(): Collection
    {
        return $this->model->where('active', ACTIVE)
            ->has('films')
            ->with('films')
            ->get();
    }
}
