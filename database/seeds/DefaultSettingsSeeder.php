<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DefaultSettingsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $now = Carbon::now('utc')->toDateTimeString();

        \App\Models\DefaultSetting::insert([
            [
                'name'       => 'abuse_rating',
                'value'      => 75,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'recommendation_preference',
                'value'      => 'Explorer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'recommendation_preference',
                'value'      => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'recommendation_threshold',
                'value'      => 0.6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'recommendation_reputation',
                'value'      => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
