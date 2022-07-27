<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = [
            1 => [
                'title' => "VINGADORES: ULTIMATO",
                'description' => mb_strtoupper("Após Thanos eliminar metade das criaturas vivas, os Vingadores têm de lidar com a perda de amigos e entes queridos. Com Tony Stark vagando perdido no espaço sem água e comida, Steve Rogers e Natasha Romanov lideram a resistência contra o titã louco"),
                'duration' => "182",
                'age_classification' => "12",
                'genre_id' => "1",
                'type_entertainment_id' => "1",
            ],
            2 => [
                'title' => "THOR",
                'description' => mb_strtoupper("Como filho de Odin, rei dos deuses nórdicos, Thor logo herdará o trono de Asgard de seu idoso pai. Porém, no dia de sua coroação, Thor reage com brutalidade quando os inimigos dos deuses entram no palácio violando o tratado. Como punição, Odin manda Thor para a Terra. Enquanto seu irmão Loki conspira em Asgard, Thor, agora sem seus poderes, enfrenta sua maior ameaça"),
                'duration' => "114",
                'age_classification' => "10",
                'genre_id' => "1",
                'type_entertainment_id' => "1",
            ],
            3 => [
                'title' => "LOKI",
                'description' => mb_strtoupper("Loki, Deus da Trapaça, sai da sombra de seu irmão para embarcar em uma aventura que ocorre após os eventos de 'Vingadores: Ultimato'"),
                'duration' => "360",
                'age_classification' => "14",
                'genre_id' => "3",
                'type_entertainment_id' => "2",
            ],
        ];
        foreach ($movies as $movie) {
            Movie::insert([
                'title' => $movie['title'],
                'description' => $movie['description'],
                'duration' => $movie['duration'],
                'age_classification' => $movie['age_classification'],
                'genre_id' => $movie['genre_id'],
                'type_entertainment_id' => $movie['type_entertainment_id'],
                'created_user_id' => '1',
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
