<?php

namespace Database\Seeders;

use App\Models\ImageMovie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            1 => [
                'path_image' => "movies/ultimato.jpg",
                'movie_id' => 1,
            ],
            2 => [
                'path_image' => "movies/thor.jpeg",
                'movie_id' => 2,
            ],
            3 => [
                'path_image' => "movies/loki.jpg",
                'movie_id' => 3,
            ],
        ];
        foreach ($images as $image) {
            ImageMovie::insert([
                'path_image' => $image['path_image'],
                'movie_id' => $image['movie_id'],
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
