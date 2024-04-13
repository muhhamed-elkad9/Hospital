<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Ray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaysController extends Controller
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $Rays = new Ray();
            $Rays->invoice_id = $request->invoice_id;
            $Rays->patient_id = $request->patient_id;
            $Rays->doctor_id = $request->doctor_id;
            $Rays->description = $request->description;
            $Rays->save();


            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $Rays = Ray::find($id);
            $Rays->description = $request->description;
            $Rays->save();


            DB::commit();
            session()->flash('edit');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Ray::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('invoices.index');
    }
}
