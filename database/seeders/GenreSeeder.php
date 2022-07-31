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
            ],
            2 => [
                'name' => 'AVENTURA',
            ],
            3 => [
                'name' => 'DRAMA',
            ],
            4 => [
                'name' => 'COMÉDIA',
            ],
            5 => [
                'name' => 'FICÇÃO CIENTÍFICA',
            ],
            5 => [
                'name' => 'TERROR',
            ],
        ];
        foreach ($genres as $genre) {
            Genre::insert([
                'name' => $genre['name'],
                'created_user_id' => '1',
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
