<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Tag::create([
           'text'   =>  'Brexit',
        ]);

        App\Models\Tag::create([
            'text'   =>  'EPL',
        ]);

        App\Models\Tag::create([
            'text'   =>  'GOP',
        ]);
    }
}
