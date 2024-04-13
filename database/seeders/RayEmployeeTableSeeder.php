<?php

namespace Database\Seeders;

use App\Models\RayEmployee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ray_employees')->delete();
        $ray_employee = new RayEmployee();
        $ray_employee->name = ('Ray Employee');
        $ray_employee->email = 'Ray@gmail.com';
        $ray_employee->password = Hash::make('123456789');
        $ray_employee->save();
    }
}
