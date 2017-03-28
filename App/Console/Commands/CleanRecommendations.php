<?php

namespace App\Console\Commands;

use App\Models\UserRecommendation;
use App\Models\ContentRecommendation;
use Illuminate\Console\Command;

class CleanRecommendations extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:recommendations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will remove any accepted recommendations from the database';

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
        UserRecommendation::query()->where('response', 1)->delete();
    }
}
