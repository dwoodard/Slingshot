<?php

namespace Dwoodard\Slingshot\Console\Commands;

use Illuminate\Console\Command;


class SlingshotReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slingshot:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Undo All Slingshot setup';

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
     * @return int
     */
    public function handle()
    {
        $this->info("Slingshot Reset");

        //Remove Laradock setup
        $this->info("- remove Laradock and Data Directories");

        $areYouSure = $this->confirm('are you sure', 'yes'); //remove yes when done
        if ($areYouSure) {

            deleteDirectory(base_path() . '/laradock');
            deleteDirectory(base_path() . '/data');
        }

        return 0;
    }
}
