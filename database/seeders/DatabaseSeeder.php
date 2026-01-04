<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ListDataTableSeeder::class);
        $this->call(ListRolesTableSeeder::class);
        
        User::create([
            'username' => 'rij0311',
            'email' => 'kradjumli@gmail.com',
            'kradworkz' => hash('sha256','kradjumli@gmail.com'),
            'password' => bcrypt('123456789'),
            'is_active' => 1,
            'must_change' => 1,
            'email_verified_at' => '2024-05-15 08:46:33',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        UserProfile::create([
            'lastname' => 'Jumli',
            'firstname' => 'Ra-ouf',
            'middlename' => 'Indanan',
            'mobile' => '09171531652',
            'mobile_hash' => hash('sha256','09171531652'),
            'sex_id' => 1,
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(LocationRegionsTableSeeder::class);
        $this->call(LocationProvincesTableSeeder::class);
        $this->call(LocationMunicipalitiesTableSeeder::class);
        $this->call(LocationBarangaysTableSeeder::class);
        $this->call(ListDropdownsTableSeeder::class);
        $this->call(ListStatusesTableSeeder::class);
        $this->call(ListLaboratoriesTableSeeder::class);
        $this->call(ListIndustriesTableSeeder::class);
        $this->call(ListDiscountsTableSeeder::class);
        $this->call(ListObjectivesTableSeeder::class);

        \DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'added_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call(FacilitiesTableSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
    }
}
