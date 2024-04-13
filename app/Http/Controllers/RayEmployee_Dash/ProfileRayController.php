<?php

namespace App\Http\Controllers\RayEmployee_Dash;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\RayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileRayController extends Controller
{

    public function index()
    {
        $info = RayEmployee::findorFail(auth()->user()->id);
        return view('Dashboard.ray_employee.profile', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = RayEmployee::findorFail($id);

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
        return redirect()->route('ProfileRay.index');
    }
}
