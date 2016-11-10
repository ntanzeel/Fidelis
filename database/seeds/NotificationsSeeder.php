<?php

use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Notification::create([
            'from_id' => 1,
            'to_id' => 2,
            'comment_id' => 1,
            'notification' => 'I agree.'
        ]);
    }
}
