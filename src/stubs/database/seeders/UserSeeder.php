<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        //create admin user
        $user = new \App\Models\User();
        $user->username = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('asdfasdf');
        $user->assignRole('admin');
        $user->settings = [
            'admin' => [
                'sidebar' => true
            ]
        ];
        $user->save();
    }
}
