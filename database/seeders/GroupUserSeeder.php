<?php

namespace Database\Seeders;

use App\Models\GroupUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            1 => [
                'name' => 'ADMINISTRADOR',
                'administrator_privilege' => true,
            ],
            2 => [
                'name' => 'GERAL',
                'administrator_privilege' => false,
            ],
            3 => [
                'name' => 'NEW WAY',
                'administrator_privilege' => false,
            ],
        ];

        foreach ($groups as $group) {
            GroupUser::insert([
                'name' => $group['name'],
                'administrator_privilege' => $group['administrator_privilege'],
                'situation' => 'A',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
