<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configurations')->delete();
        
        \DB::table('configurations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'R9',
                'name' => 'Department of Science and Technology - IX',
            'form' => '{"bank": "3402-2844-20", "time": "4:00 PM", "email": "rstl@ro9.dost.gov.ph", "address": "Pettit Baracks, Zamboanga City", "contact": "(062) 991-1024", "form_name": "TECHNICAL SERVICES REQUEST"}',
                'contact' => '[]',
                'samplecode_year' => 0,
                'show_others' => 1,
                'strict_mode' => 0,
                'region_code' => '090000000',
                'created_at' => '2026-01-04 08:15:58',
                'updated_at' => '2026-01-04 08:15:58',
            ),
        ));
        
        
    }
}