<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/seeders/json/schemas.json');
        $data = json_decode(file_get_contents($path), true);
        $data = $data[2]['data'];

        // loop through data and create pages
        foreach($data as $item){
            \App\Models\Schema::create([
                'name' => $item['name'],
                'system' => $item['system'],
                'options' => json_decode($item['options']),
                'schema' => json_decode($item['schema']),
                'model' => json_decode($item['model']),
            ]);
        }
    }
}
