<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationDistrictsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('location_districts')->delete();
        
        \DB::table('location_districts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '063022100',
                'name' => 'Arevalo',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            1 => 
            array (
                'id' => 3,
                'code' => '063022101',
                'name' => 'City Proper',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            2 => 
            array (
                'id' => 5,
                'code' => '063022102',
                'name' => 'Jaro',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            3 => 
            array (
                'id' => 6,
                'code' => '063022103',
                'name' => 'La Paz',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            4 => 
            array (
                'id' => 7,
                'code' => '063022104',
                'name' => 'Lapuz',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            5 => 
            array (
                'id' => 8,
                'code' => '063022105',
                'name' => 'Mandurriao',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
            6 => 
            array (
                'id' => 10,
                'code' => '063022106',
                'name' => 'Molo',
                'district' => NULL,
                'municipality_code' => '063022000',
            ),
        ));
        
        
    }
}