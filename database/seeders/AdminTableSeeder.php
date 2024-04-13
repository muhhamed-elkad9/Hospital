<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $users = new Admin();
        $users->name = ('Admin');
        $users->email = 'Admin@gmail.com';
        $users->password = Hash::make('123456789');
        $users->save();
    }
}
