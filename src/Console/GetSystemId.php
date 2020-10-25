<?php

namespace Rahxcr\LaravelStschk\Console;

use Illuminate\Console\Command;
use Rahxcr\LaravelStschk\LaravelStschk;

class GetSystemId extends Command
{
    protected $hidden = true; //the command can still be used and is only hidden
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sysid:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get System Hash';

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
        $this->info(LaravelStschk::UniqueMachineID());
    }
}
