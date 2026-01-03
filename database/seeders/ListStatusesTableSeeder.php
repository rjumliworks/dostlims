<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_statuses')->delete();
        
        \DB::table('list_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Pending',
                'type' => 'Request',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'For Payment',
                'type' => 'Request',
                'color' => 'bg-dark',
                'others' => 'text-dark',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ongoing',
                'type' => 'Request',
                'color' => 'bg-secondary',
                'others' => 'text-secondary',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Completed',
                'type' => 'Request',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Cancelled',
                'type' => 'Request',
                'color' => 'bg-danger',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pending',
                'type' => 'Payment',
                'color' => 'bg-warning-subtle',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Paid',
                'type' => 'Payment',
                'color' => 'bg-success-subtle',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Gratis',
                'type' => 'Payment',
                'color' => 'bg-success-subtle',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Cancelled',
                'type' => 'Payment',
                'color' => 'bg-danger-subtle',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Pending',
                'type' => 'Analysis',
                'color' => 'bg-warning-subtle',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Ongoing',
                'type' => 'Analysis',
                'color' => 'bg-secondary-subtle',
                'others' => 'text-secondary',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Completed',
                'type' => 'Analysis',
                'color' => 'bg-success-subtle',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Cancelled',
                'type' => 'Analysis',
                'color' => 'bg-danger-subtle',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Pending',
                'type' => 'Quotation',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Ongoing',
                'type' => 'Quotation',
                'color' => 'bg-info',
                'others' => 'text-info',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Completed',
                'type' => 'Quotation',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Cancelled',
                'type' => 'Quotation',
                'color' => 'bg-danger',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Contract',
                'type' => 'Payment',
                'color' => 'bg-danger-subtle',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Pending',
                'type' => 'Referral',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Ongoing',
                'type' => 'Referral',
                'color' => 'bg-secondary',
                'others' => 'text-secondary',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Completed',
                'type' => 'Referral',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Cancelled',
                'type' => 'Referral',
                'color' => 'bg-danger',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Pending',
                'type' => 'Group',
                'color' => 'bg-warning-subtle',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Confirmed',
                'type' => 'Group',
                'color' => 'bg-success-subtle',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Unprocessed',
                'type' => 'Group',
                'color' => 'bg-danger-subtle',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Pending',
                'type' => 'Releasing',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Completed',
                'type' => 'Releasing',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Pending',
                'type' => 'Disposal',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Completed',
                'type' => 'Disposal',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Completed',
                'type' => 'Testing',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 0,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Pending',
                'type' => 'Testservice',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Approved',
                'type' => 'Testservice',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Suspended',
                'type' => 'Testservice',
                'color' => 'bg-danger',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Rejected',
                'type' => 'Testservice',
                'color' => 'bg-dark',
                'others' => 'text-dark',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Operational',
                'type' => 'Equipment',
                'color' => 'bg-success',
                'others' => 'text-success',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Disposed',
                'type' => 'Equipment',
                'color' => 'bg-danger',
                'others' => 'text-danger',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Not in Use',
                'type' => 'Equipment',
                'color' => 'bg-warning',
                'others' => 'text-warning',
                'is_active' => 1,
                'created_at' => '2024-03-28 10:33:01',
                'updated_at' => '2024-03-28 10:33:01',
            ),
        ));
        
        
    }
}