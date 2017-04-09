<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        'App\Console\Commands\CleanRecommendations',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // Python scripts set to run daily for abuse detection, user and content
        // recommendations/reputation
        $schedule->exec('python "scripts\Abuse Detection\prediction.py"')->daily();
        $schedule->exec('python "scripts\Recommendation\recommendations.py"')->daily();
        $schedule->exec('python "scripts\Reputation Scoring\Post_Rep_Score.py"')->daily();
        $schedule->exec('python "scripts\Reputation Scoring\User_Rep_Score.py"')->daily();

        // User commands
        $schedule->command('clean:recommendation')->weekly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands() {
        require base_path('routes/console.php');
    }
}
