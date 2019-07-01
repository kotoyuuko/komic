<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;

class ClearExtractedCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'komic:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear extracted cache.';

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
        Storage::deleteDirectory('tmp');
    }
}
