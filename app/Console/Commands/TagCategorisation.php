<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class TagCategorisation extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:tag-categorisation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run a script to automatically categorise tags';

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
        $process = new Process('python scripts/Categorisation/predict.py');

        if ($process->run() == 0) {
            $this->info($process->getOutput());
        } else {
            $this->error($process->getErrorOutput());
        }

        return true;
    }
}
