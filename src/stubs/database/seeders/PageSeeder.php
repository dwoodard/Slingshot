<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pages.json is an export from mysql
        $path = base_path('database/seeders/json/pages.json');

        //get the data from the json file
        $pages = json_decode(file_get_contents($path), true);

        // load json file
        $pages = $pages[2]['data'];



        // loop through data and create pages
        foreach($pages as $page){
            \App\Models\Page::create($page);
        }
    }
}
