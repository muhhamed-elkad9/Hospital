<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileDoctorController extends Controller
{

    public function index()
    {
        $info = Doctor::findorFail(auth()->user()->id);
        return view('Dashboard.Doctors.profile', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = Doctor::findorFail($id);

        if (!empty($request->password)) {
            $info->name = $request->name;
            $info->email = $request->email;
            $info->password = Hash::make($request->password);
            $info->save();
        } else {
            $info->name = $request->name;
            $info->email = $request->email;
            $info->save();
        }

        session()->flash('edit');
        return redirect()->route('Profile.index');
    }
}
