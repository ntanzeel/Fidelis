<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends DatabaseSeeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Models\Setting::create([
            'user_id' => 1,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 1,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 1,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 1,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 1,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 2,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 2,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 2,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 2,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 2,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 3,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 3,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 3,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 3,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 3,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 4,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 4,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 4,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 4,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 4,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 5,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 5,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 5,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 5,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 5,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 6,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 6,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 6,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 6,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 6,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);

        App\Models\Setting::create([
            'user_id' => 7,
            'name' => 'Recommendation Preference',
            'value' => 'Explorer'
        ]);
        App\Models\Setting::create([
            'user_id' => 7,
            'name' => 'Number of Recommendations',
            'value' => 10
        ]);
        App\Models\Setting::create([
            'user_id' => 7,
            'name' => 'Threshold',
            'value' => 0.6
        ]);
        App\Models\Setting::create([
            'user_id' => 7,
            'name' => 'Reputation',
            'value' => 0
        ]);
        App\Models\Setting::create([
            'user_id' => 7,
            'name' => 'Reputation Display',
            'value' => 'Number'
        ]);
    }
}
?>