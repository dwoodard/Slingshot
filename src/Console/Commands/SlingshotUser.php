<?php

namespace Dwoodard\Slingshot\Console\Commands;

use Illuminate\Console\Command;


class SlingshotUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slingshot:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Admin User';

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
        $this->info("Slingshot User");

        //Remove Laradock setup
        $this->info("- Create User");

        $username = $this->anticipate('UserName', ['dwoodard']);
        $email = $this->anticipate('Email', ['dustin.woodard@gmail.com']);
        $password = $this->anticipate('Password', ['asdfasdf']);


        $user = new \App\Models\User();
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->save();


        if ($this->confirm('Make'. $email. 'an admin?')) {
            $user->assignRole('admin');
        }




        return 0;
    }
}
