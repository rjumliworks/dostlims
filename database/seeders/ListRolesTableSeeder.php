<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_roles')->delete();
        
        \DB::table('list_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'The highest user role defined in the system. There should only be one user account assigned for this role.',
                'has_lab' => 0,
                'is_lab' => 0,
                'is_active' => 1,
                'sequence' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Laboratory Head',
                'description' => 'The highest user role defined in the system. There should only be one user account assigned for this role.',
                'has_lab' => 0,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Technical Manager',
                'description' => 'The management role defined in the Laboratory Module. This role has the full control on the monitoring and management of all laboratory transactions which includes cancellation of requests, samples or tests.',
                'has_lab' => 1,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 3,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Customer Relation Officer',
                'description' => 'This user role is responsible in receiving samples and managing transactions in the Laboratory Module from receiving to releasing of reports.',
                'has_lab' => 0,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Laboratory Analyst',
                'description' => 'This user role allows Lab Analysts to access the eULIMS specifically the Sample Tagging module.',
                'has_lab' => 1,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 5,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Accountant',
                'description' => 'The user role defined in the Accounting Module for the monitoring of the issuance of the Order of Payment and Receipts.',
                'has_lab' => 0,
                'is_lab' => 0,
                'is_active' => 1,
                'sequence' => 10,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Cashier',
                'description' => 'This user role is assigned for users to facilitate the collection and processing of payments and deposits and is only allowed to access the cashier module.',
                'has_lab' => 0,
                'is_lab' => 0,
                'is_active' => 1,
                'sequence' => 9,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Releasing Officer',
                'description' => 'This user role is assigned for releasing of the tsr results.',
                'has_lab' => 0,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 7,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Laboratory Aide',
                'description' => 'This user role is assigned for the manner of disposal.',
                'has_lab' => 0,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 8,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Calibration Officer',
                'description' => 'This user role allows Lab Analysts to access the eULIMS specifically the Sample Tagging module.',
                'has_lab' => 1,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 6,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Top Management',
                'description' => 'This user role allows Lab Analysts to access the eULIMS specifically the Sample Tagging module.',
                'has_lab' => 0,
                'is_lab' => 1,
                'is_active' => 1,
                'sequence' => 1,
            ),
        ));
        
        
    }
}