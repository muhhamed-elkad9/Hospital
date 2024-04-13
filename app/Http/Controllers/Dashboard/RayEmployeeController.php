<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RayEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeController extends Controller
{

    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index', compact('ray_employees'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $ray_employees = new RayEmployee();
            $ray_employees->name = $request->name;
            $ray_employees->email = $request->email;
            $ray_employees->password = Hash::make($request->password);
            $ray_employees->save();


            DB::commit();
            session()->flash('add');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $input = $request->all();

            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = Arr::except($input, ['password']);
            }

            $ray_employee = RayEmployee::find($id);
            $ray_employee->update($input);


            DB::commit();
            session()->flash('edit');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        RayEmployee::destroy($id);
        session()->flash('delete');
        return redirect()->route('ray_employee.index');
    }
}
