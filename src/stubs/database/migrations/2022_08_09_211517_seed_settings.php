<?php

use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Migrations\Migration;

class SeedSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // default seeds
        $defaults = [
            'site.title' => 'Slingshot',
            'site.default_route' => 'home',
            'site.template' => 'default',
            'site.show_header_footer' => true,
        ];

        //convert the array to a collection of settings
        $settings = collect($defaults)->map(function ($value, $key) {
            return [
                'name' => $key,
                'value' => $value,
            ];
        });

        // create a one-liner for inserting a collection of settings
        $settings->each(function ($setting) {
            Setting::create($setting);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('roles')->truncate();
    }
}
