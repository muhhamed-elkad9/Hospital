<?php

namespace App\Http\Controllers\LaboratorieEmployee_Dash;

use App\Http\Controllers\Controller;
use App\Models\LaboratorieEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileLaboratorieController extends Controller
{

    public function index()
    {
        $info = LaboratorieEmployee::findorFail(auth()->user()->id);
        return view('Dashboard.laboratorie_employee.profile', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = LaboratorieEmployee::findorFail($id);

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
        return redirect()->route('ProfileLaboratorie.index');
    }
}
