<?php

use App\Film;
use Illuminate\Database\Seeder;

class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = [
            'drama' => [
                'title' => 'Dunkirk',
                'release_date' => date_create('2015-01-01')
            ],
            'gangster' => [
                'title' => 'Casino',
                'release_date' => date_create('1990-01-01')
            ],
            'fantasy' => [
                'title' => 'Spiderman',
                'release_date' => date_create('2010-01-01')
            ],
            'comedy' => [
                'title' => 'Snatch',
                'release_date' => date_create('2020-01-01')
            ],
        ];

        foreach ($films as $genre => $film) {
            $genreId = \App\Genre::where('name', $genre)->firstOrFail()->id;
            \App\Film::saveFilm($film, $genreId);
        }
    }
}
