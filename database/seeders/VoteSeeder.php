<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::insert([
            'title' => 'ADOREI',
            'description' => 'O MELHOR FILME QUE JÁ ASSISTI',
            'users_id' => 1,
            'movie_id' => 1,
            'situation' => 'A',
        ]);
    }
}
