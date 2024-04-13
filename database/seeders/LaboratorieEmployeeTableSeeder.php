<?php

namespace Database\Seeders;

use App\Models\LaboratorieEmployee;
use App\Models\RayEmployee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaboratorieEmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laboratorie_employees')->delete();
        $laboratorie_employee = new LaboratorieEmployee();
        $laboratorie_employee->name = ('Laboratorie Eemployee');
        $laboratorie_employee->email = 'laboratorie@gmail.com';
        $laboratorie_employee->password = Hash::make('123456789');
        $laboratorie_employee->save();
    }
}
