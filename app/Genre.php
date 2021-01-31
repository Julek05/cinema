<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'order',
        'active'
    ];

    public static function getGenres(): Collection
    {
        return self::select('id', 'name')
            ->where('active', ACTIVE)
            ->orderBy('order')
            ->get();
    }

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'films_genres');
    }

    public static function getFilmsByGenre(string $genre): self
    {
        return self::where('name', $genre)
            ->with(['films' => function($query) {
                $query->orderByDesc('id');
            }])
            ->firstOrFail();
    }

    public function getAllFilms(): Collection
    {
        return self::where('active', ACTIVE)
            ->has('films')
            ->with('films')
            ->get();
    }
}
