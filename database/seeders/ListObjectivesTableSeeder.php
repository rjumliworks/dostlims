<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListObjectivesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_objectives')->delete();
        
        \DB::table('list_objectives')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Samples Received',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Services Conducted',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Customers Served',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'New Customers Served',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 1,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Firms Served',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Actual Fees Collected',
                'type_id' => 76,
                'is_amount' => 1,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Values of Assistance Rendered',
                'type_id' => 76,
                'is_amount' => 1,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Paying Testing/Calibration Services Provided',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Non-Paying Testing/Calibration Services Provided',
                'type_id' => 76,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Number of Reports Generated ',
                'type_id' => 81,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Number of Late Reports',
                'type_id' => 81,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Number of Inaccurate Reports',
                'type_id' => 81,
                'is_amount' => 0,
                'is_consolidated' => 0,
                'is_active' => 1,
                'created_at' => '2025-07-02 16:41:43',
                'updated_at' => '2025-07-02 16:41:43',
            ),
        ));
        
        
    }
}