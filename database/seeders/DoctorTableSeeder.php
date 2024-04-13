<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Dates;
use App\Models\Datework;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Doctor::factory()->count(30)->create();
        // $doctors =  Doctor::factory()->count(1)->create();
        // $Dateworks = Datework::all();

        // foreach ($doctors as $doctor) {
        //     $Dates = Dates::all()->random()->id;
        //     $doctor->doctordates()->attach($Dates);
        // }

        // Doctor::all()->each(function ($doctor) use ($Dateworks) {
        //     $doctor->doctordateworks()->attach(
        //         $Dateworks->random(rand(1, 7))->pluck('id')->toArray()
        //     );
        // });

        DB::table('doctors')->delete();
        $doctors = new Doctor();
        $doctors->name = 'Doctor';
        $doctors->email = 'Doctor@gmail.com';
        $doctors->password = Hash::make('123456789');
        $doctors->phone = '+0123456789';
        $doctors->section_id = Section::all()->random()->id;
        $doctors->number_of_statements = 5;
        $doctors->save();
    }
}
