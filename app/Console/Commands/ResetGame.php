<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Redis;

class ResetGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fastquiz:reset-game --queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command resets all game scores and cleans remaining junk';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Reset the scores
        DB::table('users')->update(['score' => 0]);
        // Flush all remaining temporary question aliases
        Redis::flushall();
    }
}
