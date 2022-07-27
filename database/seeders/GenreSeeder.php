<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            1 => [
                'name' => 'AÇÃO',
                'description' => mb_strtoupper('Um filme de ação é um gênero de filme que geralmente envolve uma história de protagonistas do bem contra antagonistas do mal, que resolvem suas disputas com o uso de força física, neles o bem sempre prevalece sobre o mal'),
            ],
            2 => [
                'name' => 'ROMANCE',
                'description' => mb_strtoupper('Os filmes do gênero romance podem ser definidos como aqueles cujo enredo se desenvolve em torno de um envolvimento amoroso entre os protagonistas.')
            ],
            3 => [
                'name' => 'AVENTURA',
                'description' => mb_strtoupper('O filme de aventura é um gênero cinematográfico que pode ser caracterizado como uma história onde um herói enfrenta uma série de obstáculos, exibindo coragem ao enfrentar situações que fogem ao cotidiano')
            ]
        ];
        foreach ($genres as $genre) {
            Genre::insert([
                'name' => $genre['name'],
                'description' => $genre['description'],
                'created_user_id' => '1',
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
