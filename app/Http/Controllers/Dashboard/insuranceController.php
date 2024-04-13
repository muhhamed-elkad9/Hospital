<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class insuranceController extends Controller
{
    public function index()
    {
        $insurances = Insurance::all();
        return view('Dashboard.insurance.index', compact('insurances'));
    }

    public function create()
    {
        return view('Dashboard.insurance.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $insurances = new Insurance();
            $insurances->insurance_code = $request->insurance_code;
            $insurances->discount_percentage = $request->discount_percentage;
            $insurances->Company_rate = $request->Company_rate;
            $insurances->status = 1;
            $insurances->save();
            // store trans
            $insurances->name = $request->name;
            $insurances->notes = $request->notes;
            $insurances->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('insurance.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $insurances = Insurance::find($id);
        return view('Dashboard.insurance.edit', compact('insurances'));
    }

    public function update(Request $request)
    {

        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

        $insurances = insurance::findOrFail($request->id);

        $insurances->update($request->all());

        // insert trans
        $insurances->name = $request->name;
        $insurances->notes = $request->notes;
        $insurances->save();

        session()->flash('edit');
        return redirect()->route('insurance.index');
    }

    public function destroy(Request $request)
    {
        Insurance::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('insurance.index');
    }
}
