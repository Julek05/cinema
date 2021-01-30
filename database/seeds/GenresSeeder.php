<?php

use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [[
                'name' => 'drama',
                'order' => 1,
                'active' => '1',
            ], [
                'name' => 'gangster',
                'order' => 2,
                'active' => '1',
            ], [
                'name' => 'fantasy',
                'order' => 3,
                'active' => '1',
            ], [
                'name' => 'comedy',
                'order' => 4,
                'active' => '1',
            ]
        ];

        foreach ($genres as $genre) {
            \App\Genre::create($genre);
        }
    }
}
