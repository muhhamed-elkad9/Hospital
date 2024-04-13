<?php

namespace App\Http\Controllers\Patient_Dash;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Laboratorie;
use App\Models\Ray;
use App\Models\ReceiptAccount;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function invoices()
    {

        $invoices = Invoice::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patients.invoices', compact('invoices'));
    }

    public function laboratories()
    {

        $laboratories = Laboratorie::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patients.laboratories', compact('laboratories'));
    }

    public function viewLaboratories($id)
    {

        $laboratorie = Laboratorie::findorFail($id);
        if ($laboratorie->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.patients.patient_details', compact('laboratorie'));
    }

    public function rays()
    {

        $rays = Ray::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patients.rays', compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findorFail($id);
        if ($rays->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.patients.patient_details', compact('rays'));
    }

    public function payments()
    {

        $payments = ReceiptAccount::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.patients.payments', compact('payments'));
    }
}
