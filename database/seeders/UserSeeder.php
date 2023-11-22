<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username'=>'admin',
                'name'=>'admin',
                'password'=>bcrypt('admin'),
            ],
            [
                'username'=>'admin2',
                'name'=>'admin2',
                'password'=>bcrypt('admin2'),
            ],
        ];
    }
}
