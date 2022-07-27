<?php

namespace Database\Seeders;

use App\Models\TypeEntertainment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeEntertainmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            1 => [
                'name' => 'FILME',
                'description' => mb_strtoupper('Sequência de imagens em movimento com som sincronizado que conta uma história'),
            ],
            2 => [
                'name' => 'SÉRIE',
                'description' => mb_strtoupper('Programas de televisão que envolvem uma continuidade na narração')
            ],
        ];
        foreach ($types as $type) {
            TypeEntertainment::insert([
                'name' => $type['name'],
                'description' => $type['description'],
                'created_user_id' => '1',
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
