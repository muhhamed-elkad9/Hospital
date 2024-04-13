<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbulanceController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('Dashboard.Ambulances.index', compact('ambulances'));
    }

    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $ambulances = new Ambulance();
            $ambulances->car_number = $request->car_number;
            $ambulances->car_model = $request->car_model;
            $ambulances->car_year_made = $request->car_year_made;
            $ambulances->car_type = $request->car_type;
            $ambulances->driver_license_number = $request->driver_license_number;
            $ambulances->driver_phone = $request->driver_phone;
            $ambulances->is_available = 1;
            $ambulances->save();
            // store trans
            $ambulances->driver_name = $request->driver_name;
            $ambulances->notes = $request->notes;
            $ambulances->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Ambulance.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ambulance = Ambulance::find($id);
        return view('Dashboard.Ambulances.edit', compact('ambulance'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);


        $ambulance = Ambulance::findOrFail($request->id);

        $ambulance->update($request->all());

        // store trans
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->save();

        session()->flash('edit');
        return redirect()->route('Ambulance.index');
    }

    public function destroy(Request $request)
    {
        Ambulance::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Ambulance.index');
    }
}
