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
        'App\Console\Commands\Recommendations',
        'App\Console\Commands\AbuseDetection',
        'App\Console\Commands\PostReputation',
        'App\Console\Commands\UserReputation',
        'App\Console\Commands\TagCategorisation',
        'App\Console\Commands\CleanRecommendations',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        /*
         * Tasks set to run daily
         */
        $schedule->command('script:post-reputation')->daily();
        $schedule->command('script:user-reputation')->daily();
        $schedule->command('script:recommendation')->daily();
        $schedule->command('script:abuse-detection')->daily();
        $schedule->command('script:tag-categorisation')->daily();
        //$schedule->command('clean:recommendation')->weekly();
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
