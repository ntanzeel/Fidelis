<?php

use Illuminate\Database\Seeder;

class QuotesSeeder extends Seeder {

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

        App\Models\Quote::create([
            'text'  => 'The glue that holds all relationships together--including the relationship between the
             leader and the led - is trust, and trust is based on integrity.',
            'by'    => 'Brian Tracy'
        ]);

        App\Models\Quote::create([
            'text'  => 'It is mutual trust, even more than mutual interest, that holds human associations together.',
            'by'    => 'H. L. Mencken'
        ]);

        App\Models\Quote::create([
            'text'  => 'Trust is built with consistency.',
            'by'    => 'Lincoln Chafee'
        ]);
    }
}
