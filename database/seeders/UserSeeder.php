<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
                'role'=>'admin',
                'password'=>bcrypt('admin'),
            ],
            [
                'username'=>'admin2',
                'name'=>'admin2',
                'role'=>'admin',
                'password'=>bcrypt('admin2'),
            ],
        ];
        foreach ($data as $value) {
            User::create($value);
        }
    }
}
