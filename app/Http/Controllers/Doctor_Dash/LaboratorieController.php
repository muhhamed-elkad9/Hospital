<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Laboratorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratorieController extends Controller
{

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $Laboratorie = new Laboratorie();
            $Laboratorie->invoice_id = $request->invoice_id;
            $Laboratorie->patient_id = $request->patient_id;
            $Laboratorie->doctor_id = $request->doctor_id;
            $Laboratorie->description = $request->description;
            $Laboratorie->save();


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

            $Laboratorie = Laboratorie::find($id);
            $Laboratorie->description = $request->description;
            $Laboratorie->save();


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
        Laboratorie::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('invoices.index');
    }
}
