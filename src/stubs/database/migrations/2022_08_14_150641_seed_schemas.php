<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema as SchemaAlias;
use App\Models\Schema;

class SeedSchemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create([
            'name' => 'settings',

            'model' => [
                "general" => [
                    "siteTitle" => "Project from db",
                    "defaultPage" => "home-db",
                ],

                "layouts" => [
                    "template" => "default"
                ],


            ],
            // 'options' => [],
            // 'schema' => [],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::truncate();
    }
}
