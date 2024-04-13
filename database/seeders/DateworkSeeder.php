<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Datework;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dateworks')->delete();
        $Dateworks = [
            ['name' => 'السبت'],
            ['name' => 'الاحد'],
            ['name' => 'الاثنين'],
            ['name' => 'الثلاثاء'],
            ['name' => 'الاربعاء'],
            ['name' => 'الخميس'],
            ['name' => 'الجمعة'],
        ];
        foreach ($Dateworks as $Datework) {
            Datework::create($Datework);
        }
    }
}
