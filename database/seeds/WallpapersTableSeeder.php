<?php

use Illuminate\Database\Seeder;

class WallpapersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($i = 1; $i <= 100; $i++) {
            \App\Models\Wallpaper::create([
                'path' => 'assets/images/wallpapers/' . $i . '.jpeg'
            ]);
        }
    }
}
