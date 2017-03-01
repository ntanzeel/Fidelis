<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(UsersSeeder::class);
        $this->call(WallpapersSeeder::class);
        $this->call(QuotesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(FollowersSeeder::class);
        $this->call(DefaultSettingsSeeder::class);
        // $this->call(SubscriptionsSeeder::class);
        $this->call(PostsSeeder::class);
         $this->call(CommentsSeeder::class);
        // $this->call(ImagesSeeder::class);
         $this->call(VotesSeeder::class);
         $this->call(SettingsSeeder::class);
        // $this->call(NotificationsSeeder::class);
    }
}
