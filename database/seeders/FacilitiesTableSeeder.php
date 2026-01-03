<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facilities')->delete();
        
        \DB::table('facilities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Regional Standard and Testing Laboratory',
                'short' => 'RSTL',
                'is_regional' => 1,
                'is_separated' => 0,
                'is_psto' => 0,
                'address' => 'Pettit Barracks',
                'longitude' => '122.079713',
                'latitude' => '6.90335',
                'is_active' => 1,
                'barangay_code' => '097332064',
                'municipality_code' => '097332000',
                'province_code' => '097300000',
                'region_code' => '090000000',
                'created_at' => '2026-01-03 09:15:50',
                'updated_at' => '2026-01-03 09:15:50',
            ),
        ));
        
        
    }
}