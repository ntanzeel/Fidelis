<?php

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Image::create([
            'post_id' => 1,
            'path'    => 'http://i1.mirror.co.uk/incoming/article101472.ece/ALTERNATES/s1200/boris-johnson-pic-rex-149163468.jpg',
        ]);
        Image::create([
            'post_id' => 4,
            'path'    => 'http://cdn3.24live.co/images/2016/05/26/1464254630422620.jpg',
        ]);
    }
}
