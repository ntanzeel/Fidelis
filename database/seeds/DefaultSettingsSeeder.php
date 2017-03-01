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
            ], [
                'name'       => 'is_private',
                'value'      => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
