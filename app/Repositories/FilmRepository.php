<?php

namespace App\Repositories;

use App\Contracts\FilmRepositoryInterface;
use App\Film;
use Illuminate\Support\Facades\DB;

class FilmRepository implements FilmRepositoryInterface
{
    private Film $model;

    public function __construct(Film $model)
    {
        $this->model = $model;
    }

    /**
     * @param mixed[] $film
     * @param string[] $genres
     * @return array
     */
    public function saveFilm(array $film, array $genres): array
    {
        DB::beginTransaction();
        try {
            $film = $this->model->create($film);

            $film->genres()->attach($genres);
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => 'Film adding failed'];
        }

        DB::commit();
        return ['success' => 'Film added'];
    }

    public function deleteFilm(int $id): void
    {
        $film = $this->model->findOrFail($id);

        $film->genres()->detach();
        $film->delete();
    }

    public function getFilm(int $id): Film
    {
        return $this->model->with('genres')
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param array $updatedFilm
     * @param string[] $genres
     * @param int $id
     * @return array
     */
    public function updateFilm(array $updatedFilm, array $genres, int $id): array
    {
        DB::beginTransaction();
        try {
            $actualFilm = $this->model->findOrFail($id);

            $actualFilm->update($updatedFilm);

            $actualFilm->genres()->sync($genres);

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => 'Film editing failed'];
        }

        DB::commit();
        return ['success' => 'Film edited'];
    }
}
