<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        App\Models\Category::create([
//            'name'  =>  'Politics',
//            'description'   =>  'Politically-related content',
//        ]);

        $politics = new App\Models\Category([
            'name'  =>  'Politics',
            'description'   =>  'Politically-related content',
        ]);

        $politics->save();

        $brexit = new App\Models\Tag([
            'text'   =>  'Brexit',
        ]);

        $brexit->save();

        $politics->tags()->attach($brexit->id);

//        App\Models\Category::create([
//            'name'  =>  'Sports',
//            'description'   =>  'FOOTBALL',
//        ]);
    }
}
