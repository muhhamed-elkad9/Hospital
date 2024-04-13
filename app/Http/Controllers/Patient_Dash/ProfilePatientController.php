<?php

namespace App\Http\Controllers\Patient_Dash;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilePatientController extends Controller
{

    public function index()
    {
        $info = Patient::findorFail(auth()->user()->id);
        return view('Dashboard.Patients.profile', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = Patient::findorFail($id);

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
        return redirect()->route('ProfilePatient.index');
    }
}
