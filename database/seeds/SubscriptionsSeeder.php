<?php

use Illuminate\Database\Seeder;

class SubscriptionsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\Subscription::create([
            'user_id'   => 1,
            'tag_id'    => 1
        ]);

        App\Models\Subscription::create([
            'user_id'   => 1,
            'tag_id'    => 3
        ]);

        App\Models\Subscription::create([
            'user_id'   => 2,
            'tag_id'    => 1
        ]);

        App\Models\Subscription::create([
            'user_id'   => 3,
            'tag_id'    => 2
        ]);
    }
}
