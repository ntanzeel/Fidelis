<?php

use App\Models\Vote;
use Illuminate\Database\Seeder;

class VotesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Vote::create([
            'user_id'    => 7,
            'comment_id' => 7,
            'type'       => 1,
        ]);
        Vote::create([
            'user_id'    => 7,
            'comment_id' => 6,
            'type'       => 1,
        ]);
    }
}
