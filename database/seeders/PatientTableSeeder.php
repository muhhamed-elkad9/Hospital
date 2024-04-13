<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientTableSeeder extends Seeder
{

    public function run()
    {
        $Patients = new Patient();
        $Patients->email = 'patient@gmail.com';
        $Patients->password = Hash::make('123456789');
        $Patients->Date_Birth = '1988-12-01';
        $Patients->Phone = '+0123456789';
        $Patients->Gender = 1;
        $Patients->Blood_Group = 'A+';
        $Patients->save();

        //insert trans
        $Patients->name = 'Patient';
        $Patients->Address = 'القاهرة';
        $Patients->save();
    }
}
