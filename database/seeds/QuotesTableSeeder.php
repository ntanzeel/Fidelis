<?php

use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\Quote::create([
            'text'  => 'Trust, but verify.',
            'by'    => 'Ronald Reagan'
        ]);

        App\Models\Quote::create([
            'text'  => 'Love all, trust a few, do wrong to none.',
            'by'    => 'William Shakespeare'
        ]);
    }
}
