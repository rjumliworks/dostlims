<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListLaboratoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_laboratories')->delete();
        
        \DB::table('list_laboratories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Chemical Laboratory',
                'short' => 'CHE',
                'color' => 'red',
                'is_active' => 1,
                'created_at' => '2024-07-30 19:05:19',
                'updated_at' => '2024-07-30 19:05:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Microbiological Laboratory',
                'short' => 'MIC',
                'color' => 'green',
                'is_active' => 1,
                'created_at' => '2024-07-30 19:05:19',
                'updated_at' => '2024-07-30 19:05:19',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Metrology Laboratory',
                'short' => 'MET',
                'color' => 'blue',
                'is_active' => 1,
                'created_at' => '2024-07-30 19:05:19',
                'updated_at' => '2024-07-30 19:05:19',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Rubber Laboratory',
                'short' => 'RUB',
                'color' => 'orange',
                'is_active' => 1,
                'created_at' => '2024-07-30 19:05:19',
                'updated_at' => '2024-07-30 19:05:19',
            ),
        ));
        
        
    }
}