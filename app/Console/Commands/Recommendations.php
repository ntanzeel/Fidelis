<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Recommendations extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:recommendations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run the script that will generate content recommendations for Fidelis users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $process = new Process('python "scripts\Recommendation\recommendations.py"');
        $process->run();
    }
}
