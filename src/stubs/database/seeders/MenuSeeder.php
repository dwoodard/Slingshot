<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Welcome menu
        $menu = new \App\Models\Menu();
        $menu->parent_id = null;
        $menu->title = 'Welcome';
        $menu->link = '/welcome';
        $menu->category = 'main';
        $menu->type = 'relative';
        $menu->target = '__blank';
        $menu->icon = 'fa-home';
        $menu->show_icon = true;
        $menu->order = 0;
        $menu->admin = false;
        $menu->hide_link = false;
        $menu->save();







    }
}
