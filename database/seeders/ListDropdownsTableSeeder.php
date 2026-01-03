<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListDropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('list_dropdowns')->delete();
        
        \DB::table('list_dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'classification' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Regional Standards and Testing Laboratories',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'RSTL',
                'is_active' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Research and Development Institutes',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'RDI',
                'is_active' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Regional Metrology Lab',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'RML',
                'is_active' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Regional Volumetric Calibration Laboratory',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'RVCL',
                'is_active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cavite Water & Wastewater Testing Laboratory',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'CWWTL',
                'is_active' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Private Sector',
                'classification' => 'Agency Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'PS',
                'is_active' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Firm',
                'classification' => 'Class',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Individual',
                'classification' => 'Class',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Percentage',
                'classification' => 'Discount',
                'type' => 'Subtype',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Amount',
                'classification' => 'Discount',
                'type' => 'Subtype',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Unlimited',
                'classification' => 'Discount',
                'type' => 'Type',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Limited',
                'classification' => 'Discount',
                'type' => 'Type',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Total Based',
                'classification' => 'Discount',
                'type' => 'Based',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Item Based',
                'classification' => 'Discount',
                'type' => 'Based',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Occasional Based',
                'classification' => 'Discount',
                'type' => 'Based',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Cash',
                'classification' => 'Payment Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Cheque',
                'classification' => 'Payment Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'Cheque Number',
                'is_active' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Money Order',
                'classification' => 'Payment Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Bank Deposit',
                'classification' => 'Payment Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'Number',
                'is_active' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Wallet',
                'classification' => 'Payment Mode',
                'type' => 'wallet',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Online Transfer',
                'classification' => 'Payment Mode',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'Source Account',
                'is_active' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Analysis Fee',
                'classification' => 'Collection Type',
                'type' => 'Laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Calibration Fee',
                'classification' => 'Collection Type',
                'type' => 'Laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Analysis/Calibration Fee',
                'classification' => 'Collection Type',
                'type' => 'Laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Bureau of Treasury',
                'classification' => 'Deposit Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Project',
                'classification' => 'Deposit Type',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Method',
                'classification' => 'Service Name',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Reference',
                'classification' => 'Service Name',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Sample Type',
                'classification' => 'Service Name',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Test Name',
                'classification' => 'Service Name',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Chemical',
                'classification' => 'Inventory',
                'type' => 'Category',
                'color' => 'success',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Media',
                'classification' => 'Inventory',
                'type' => 'Category',
                'color' => 'primary',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Supplies',
                'classification' => 'Inventory',
                'type' => 'Category',
                'color' => 'warning',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Piece',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'piece',
                'others' => 'pc',
                'is_active' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Liter',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'volume',
                'others' => 'L',
                'is_active' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Milliliter',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'volume',
                'others' => 'ml',
                'is_active' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Kilogram',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'mass',
                'others' => 'kg',
                'is_active' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Gram',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'mass',
                'others' => 'g',
                'is_active' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Calibration',
                'classification' => 'Inventory',
                'type' => 'Equipment',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Intermediate Check',
                'classification' => 'Inventory',
                'type' => 'Equipment',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Characterization',
                'classification' => 'Inventory',
                'type' => 'Equipment',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Official Travel',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-success',
                'is_active' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Meeting',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-info',
                'others' => 'bg-info-subtle',
                'is_active' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Audit',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-warning',
                'others' => 'bg-warning-subtle',
                'is_active' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Review',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-primary',
                'others' => 'bg-primary-subtle',
                'is_active' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Leave',
                'classification' => 'Events',
                'type' => 'n/a',
                'color' => 'text-danger',
                'others' => 'bg-danger-subtle',
                'is_active' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Holiday',
                'classification' => 'Events',
                'type' => 'n/a',
                'color' => 'text-dark',
                'others' => 'bg-dark-subtle',
                'is_active' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Setup Project Payment',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Scholarship Assistance',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Refund of Travel',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Bidding Paper',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Others',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Testing Fee',
                'classification' => 'Collection Type',
                'type' => 'Laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Collected by Staff',
                'classification' => 'Disposal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Disposal to Sink after Treatment',
                'classification' => 'Disposal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Disposed to Garbage',
                'classification' => 'Disposal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Refund of Excess in CA',
                'classification' => 'Collection Type',
                'type' => 'Non-laboratory',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Regulatory',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Academic and Research',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Quality Control',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Export or Market Requirement',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            62 => 
            array (
                'id' => 63,
            'name' => 'Calibration (DOST-IX)',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-primary',
                'is_active' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'BOD Schedule',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-info',
                'is_active' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Others',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-warning',
                'is_active' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Private Individual',
                'classification' => 'Individual',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Senior Citizen',
                'classification' => 'Individual',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Student',
                'classification' => 'Individual',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Milligram',
                'classification' => 'Inventory',
                'type' => 'Unit',
                'color' => 'mass',
                'others' => 'mg',
                'is_active' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Male',
                'classification' => 'Sex',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Female',
                'classification' => 'Sex',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Not Applicable',
                'classification' => 'Sex',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Female',
                'classification' => 'Female',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Female-led',
                'classification' => 'Female',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'GAD Activity',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-purple',
                'is_active' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'OneLab KPI - Objective 1',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'OneLab KPI - Objective 2',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 0,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'OneLab KPI - Objective 3',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 0,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'OneLab KPI - Objective 4',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 0,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Balance Score Card',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            80 => 
            array (
                'id' => 81,
            'name' => 'Laboratory Policies (QM-004)',
                'classification' => 'Objective',
                'type' => 'n/a',
                'color' => 'text-white',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Male',
                'classification' => 'Male',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Male-led',
                'classification' => 'Male',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            83 => 
            array (
                'id' => 84,
            'name' => 'Regulatory (FDA)',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Cancel',
                'classification' => 'Remarks',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Refund',
                'classification' => 'Remarks',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Forwarded to Chemical Laboratory',
                'classification' => 'Disposal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Decontaminate/Autoclave',
                'classification' => 'Disposal',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            88 => 
            array (
                'id' => 89,
            'name' => 'Calibration (Onsite)',
                'classification' => 'Events',
                'type' => 'official',
                'color' => 'text-white',
                'others' => 'bg-danger',
                'is_active' => 1,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Discount',
                'classification' => 'Remarks',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Customer Requirement',
                'classification' => 'Purpose',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Person with Disability',
                'classification' => 'Individual',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
                'is_active' => 1,
            ),
        ));
        
        
    }
}