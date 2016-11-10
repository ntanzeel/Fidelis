<?php

use App\Models\Follower;
use Illuminate\Database\Seeder;

class FollowersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Follower::create([
            'follower_id'  => 1,
            'following_id' => 2,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 1,
            'following_id' => 3,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 1,
            'following_id' => 4,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 2,
            'following_id' => 1,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 2,
            'following_id' => 3,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 2,
            'following_id' => 4,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 3,
            'following_id' => 1,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 3,
            'following_id' => 2,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 3,
            'following_id' => 4,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 4,
            'following_id' => 1,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 4,
            'following_id' => 2,
            'mutual'       => 1,
            'approved'     => 1,
        ]);

        Follower::create([
            'follower_id'  => 4,
            'following_id' => 3,
            'mutual'       => 1,
            'approved'     => 1,
        ]);
    }
}
