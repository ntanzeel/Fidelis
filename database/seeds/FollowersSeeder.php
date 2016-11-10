<?php

use Illuminate\Database\Seeder;
use App\Models\Follower;

class FollowersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$follower = Follower::create([
            'follower_id' => 1,
			'following_id' => 2
        ]);
		$follower = Follower::create([
            'follower_id' => 1,
			'following_id' => 4
        ]);
		$follower = Follower::create([
            'follower_id' => 3,
			'following_id' => 4
        ]);
		$follower = Follower::create([
            'follower_id' => 4,
			'following_id' => 1
        ]);
		$follower = Follower::create([
            'follower_id' => 1,
			'following_id' => 4
        ]);
    }
}
