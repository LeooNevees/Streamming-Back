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
            'users_id' => 1,
            'movie_id' => 1,
            'situation' => 'A',
        ]);
    }
}
