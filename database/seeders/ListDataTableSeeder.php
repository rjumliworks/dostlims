<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDataTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_data')->delete();
        
        \DB::table('list_data')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'type' => 'n/a',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Jr.',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sr.',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'II',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'III',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'IV',
                'type' => 'Suffix',
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Male',
                'type' => 'Sex',
                'is_active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Female',
                'type' => 'Sex',
                'is_active' => 1,
            ),
        ));
        
        
    }
}