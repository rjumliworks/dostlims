<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_discounts')->delete();
        
        \DB::table('list_discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Regular',
                'value' => '0',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 11,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Student',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Senior Citizen',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Persons with Disabilities',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Fully Subsidized',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Gratis',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Health Units',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            7 => 
            array (
                'id' => 8,
            'name' => 'Discount for Rubber (80)',
                'value' => '80',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Women\'s Month',
                'value' => '20',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 13,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Gratis - Calibration',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Gratis - R&D',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Gratis - QC',
                'value' => '100',
                'from' => NULL,
                'to' => NULL,
                'based_id' => 14,
                'type_id' => 12,
                'subtype_id' => 10,
                'is_active' => 1,
                'created_at' => '2024-03-27 11:14:39',
                'updated_at' => '2024-03-27 11:14:39',
            )
        ));
        
        
    }
}