<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Film extends Model
{
    protected $fillable = [
      'title',
      'release_date',
    ];

    /**
     * @param mixed[] $film
     * @param string[] $genres
     * @return array
     */
    public static function saveFilm(array $film, array $genres): array
    {
        DB::beginTransaction();
        try {
            $film = self::create($film);

            $film->genres()->attach($genres);
        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => 'Film adding failed'];
        }

        DB::commit();
        return ['success' => 'Film added'];
    }

    public static function deleteFilm(int $id): void
    {
        $film = self::findOrFail($id);

        $film->genres()->detach();
        $film->delete();
    }

    public static function getFilm(int $id): self
    {
        return self::with('genres')
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param array $updatedFilm
     * @param string[] $genres
     * @param int $id
     * @return array
     */
    public static function updateFilm(array $updatedFilm, array $genres, int $id): array
    {
        DB::beginTransaction();
        try {
            $actualFilm = self::findOrFail($id);

            $actualFilm->update($updatedFilm);

            $actualFilm->genres()->sync($genres);

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => 'Film editing failed'];
        }

        DB::commit();
        return ['success' => 'Film edited'];
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
    }
}
