<?php

use Illuminate\Database\Seeder;
use App\Models\Vote;

class VotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$vote = Vote::create([
            'user_id' => 1,
			'comment_id' => 3,
			'type' => 'like'
        ]);
		$vote = Vote::create([
            'user_id' => 2,
			'comment_id' => 3,
			'type' => 'dislike'
        ]);
		$vote = Vote::create([
            'user_id' => 2,
			'comment_id' => 4,
			'type' => 'like'
        ]);
		$vote = Vote::create([
            'user_id' => 4,
			'comment_id' => 1,
			'type' => 'like'
        ]);
		$vote = Vote::create([
            'user_id' => 3,
			'comment_id' => 2,
			'type' => 'dislike'
        ]);
    }
}
