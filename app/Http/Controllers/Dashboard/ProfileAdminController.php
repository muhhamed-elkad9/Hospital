<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{

    public function index()
    {
        $info = Admin::findorFail(auth()->user()->id);
        return view('Dashboard.Admin.profile', compact('info'));
    }

    public function update(Request $request, $id)
    {
        $info = Admin::findorFail($id);

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
        return redirect()->route('ProfileAdmin.index');
    }
}
