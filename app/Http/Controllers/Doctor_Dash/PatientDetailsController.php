<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Diagnostic;
use App\Models\Laboratorie;
use App\Models\Ray;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller
{

    public function index($id)
    {
        $patient_records = Diagnostic::where('patient_id', $id)->get();
        $patient_rays = Ray::where('patient_id', $id)->get();
        $patient_Laboratories = Laboratorie::where('patient_id', $id)->get();
        return view('Dashboard.Doctors.invoices.patient_details', compact('patient_records', 'patient_rays', 'patient_Laboratories'));
    }
}
