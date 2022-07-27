<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GroupUserSeeder::class,
            UserSeeder::class,
            GenreSeeder::class,
            TypeEntertainmentSeeder::class,
            MovieSeeder::class,
            VoteSeeder::class,
        ]);
    }
}
