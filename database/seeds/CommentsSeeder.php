<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 1,
            'content'    => 'If Trump is elected as president we will see positive changes in American politics',
            'reputation' => 10,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 4,
            'post_id'    => 2,
            'content'    => 'Mourinho will not be a successful manager for Manchester United',
            'reputation' => 4,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 3,
            'post_id'    => 3,
            'content'    => 'Kanye West is one of the greatest fashion designers of our generation',
            'reputation' => -10,
            'root'       => true,
        ]);

        App\Models\Comment::create([
            'user_id'    => 1,
            'post_id'    => 1,
            'content'    => 'I agree, they should have stuck with Van Gaal for a while longer',
            'reputation' => 2,
            'root'       => false,
        ]);
    }
}
