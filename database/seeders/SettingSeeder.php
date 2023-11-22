<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::first();
        if (!$setting) {
            Setting::create([
                'attempt'=>'5',
                'obstacle'=>'active',
                'colorOne'=>'#f01d1d',
                'colorTwo'=>'#eeff00',
                'background'=>'#0352fc',
                'audio'=>'audio.mp3',
                'audioPlay'=>'active',
            ]);
        }
    }
}
