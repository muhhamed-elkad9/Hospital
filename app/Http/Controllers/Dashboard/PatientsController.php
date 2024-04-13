<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientsController extends Controller
{

    public function index()
    {
        $Patients = Patient::all();
        return view('Dashboard.Patients.index', compact('Patients'));
    }

    public function create()
    {
        return view('Dashboard.Patients.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $Patients = new Patient();
            $Patients->email = $request->email;
            $Patients->Password = Hash::make($request->Password);
            $Patients->Date_Birth = $request->Date_Birth;
            $Patients->Phone = $request->Phone;
            $Patients->Gender = $request->Gender;
            $Patients->Blood_Group = $request->Blood_Group;
            $Patients->save();
            // store trans
            $Patients->name = $request->name;
            $Patients->Address = $request->Address;
            $Patients->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $Patient = patient::findorfail($id);
        $invoices = Invoice::where('patient_id', $id)->get();
        $receipt_accounts = ReceiptAccount::where('patient_id', $id)->get();
        $Patient_accounts = PatientAccount::where('patient_id', $id)->get();

        return view('Dashboard.Patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
    }

    public function edit($id)
    {
        $Patient = Patient::find($id);
        return view('Dashboard.Patients.edit', compact('Patient'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $Patients = Patient::find($id);
            $Patients->email = $request->email;
            $Patients->Password = Hash::make($request->Password);
            $Patients->Date_Birth = $request->Date_Birth;
            $Patients->Phone = $request->Phone;
            $Patients->Gender = $request->Gender;
            $Patients->Blood_Group = $request->Blood_Group;
            $Patients->save();
            // store trans
            $Patients->name = $request->name;
            $Patients->Address = $request->Address;
            $Patients->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Patients.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        Patient::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('Patients.index');
    }
}
