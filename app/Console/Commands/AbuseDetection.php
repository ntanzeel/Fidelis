<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class AbuseDetection extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:abuse-detection {--reported}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run script for abuse detection';

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
        $process = new Process('cd scripts/Abuse\ Detection/; python prediction.py ' . ($this->option('reported') ? 'true' : 'false'));

        if ($process->run() == 0) {
            $this->info($process->getOutput());
        } else {
            $this->error($process->getErrorOutput());
        }

        return true;
    }
}
