<?php

namespace Dwoodard\Slingshot\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;


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

        $this->info("- Create User");

        $username = $this->anticipate('UserName', ['dwoodard']);
        $email = $this->anticipate('Email', ['dustin.woodard@gmail.com']);
        $password = $this->choice('Password', ['asdfasdf'], 0);


        $user = User::updateOrCreate([
            'email' => $email,
        ], [
            'username' => $username,
            'password' => Hash::make($password),
        ]);


        if ($this->confirm('Make ' . $email . 'an admin?')) {
            $user->assignRole('admin');
        }


        return 0;
    }
}
