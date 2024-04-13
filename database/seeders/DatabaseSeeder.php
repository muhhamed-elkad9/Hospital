<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            DateworkSeeder::class,
            SectionTableSeeder::class,
            DoctorTableSeeder::class,
            ImageTableSeeder::class,
            RayEmployeeTableSeeder::class,
            PatientTableSeeder::class,
            ServiceTableSeeder::class,
            LaboratorieEmployeeTableSeeder::class,
        ]);
    }
}
