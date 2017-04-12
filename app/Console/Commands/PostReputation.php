<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PostReputation extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:post-reputation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run script for calculating post reputations';

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
        $process = new Process('python "scripts\Reputation Scoring\Post_Rep_Score.py"');
        $process->run();
    }
}
