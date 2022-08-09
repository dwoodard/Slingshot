<?php

namespace Database\Seeders;

use App\Models\Menu;
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
        $header = new Menu();
        $header->title = 'Header';
        $header->location = 'header';
        $header->items = [
            [
                'title' => 'Welcome',
                'link' => '/welcome',
                'type' => 'internal',
                'target' => null,
                'icon' => 'mdi-home',
                'show_icon' => true,
                'order' => 0,
                'admin' => false,
                'hide_link' => false,
            ],
            [
                'title' => 'About',
                'link' => '/about',
                'type' => 'internal',
                'target' => null,
                'icon' => 'mdi-account',
                'show_icon' => true,
                'order' => 1,
                'admin' => false,
                'hide_link' => false,
            ]
        ];
        $header->save();


        $footer = new Menu();
        $footer->title = 'Footer';
        $footer->location = 'footer';
        $footer->items = [
            [
                'title' => 'Welcome',
                'link' => '/welcome',
                'type' => 'internal',
                'target' => '_self',
                'icon' => 'mdi-home',
                'show_icon' => true,
                'order' => 0,
                'admin' => false,
                'hide_link' => false,
            ]
        ];
        $footer->save();








    }
}
