<?php

namespace App\Repositories;

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

    public function getActiveGenres(array $neededFields): Collection
    {
        return $this->model->select($neededFields)
            ->where('active', ACTIVE)
            ->orderBy('id')
            ->get();
    }

    public function getAllGenres(): Collection
    {
        return $this->model->select('id', 'name', 'active')
            ->orderBy('id')
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

    public function store(array $genre): void
    {
        if (isset($genre['active']) && $genre['active'] === CHECKED_CHECKBOX) {
            $genre['active'] = ACTIVE;
        } else {
            $genre['active'] = INACTIVE;
        }

        $this->model->create($genre);
    }

    public function destroy(int $id): void
    {
        $genre = $this->model->findOrFail($id);

        $genre->films()->detach();
    }

    public function update(array $genre, int $id): void
    {
        if (isset($genre['active']) && $genre['active'] === CHECKED_CHECKBOX) {
            $genre['active'] = ACTIVE;
        } else {
            $genre['active'] = INACTIVE;
        }

        $this->model->findOrFail($id)->update($genre);
    }

    public function getSpecificGenre(int $id): Genre
    {
        return $this->model->findOrFail($id);
    }
}
