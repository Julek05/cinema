<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Film extends Model
{
    protected $fillable = [
      'title',
      'release_date',
    ];

    /**
     * @param mixed[] $film
     * @param string[] $genres
     */
    public static function saveFilm(array $film, array $genres): void
    {
       $film = Film::create($film);

       $film->genres()->attach($genres);
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

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'films_genres');
    }
}
