<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Ray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class invoicesController extends Controller
{

    // قائمة الكشوفات تحت الاجراء
    public function index()
    {
        $invoices = Invoice::where('doctor_id',  Auth::user()->id)->where('invoice_status', 1)->get();
        return view('Dashboard.Doctors.invoices.index', compact('invoices'));
    }

    // قائمة المراجعات
    public function reviewInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('Dashboard.Doctors.invoices.review_invoices', compact('invoices'));
    }

    // قائمة الفواتير المكتملة
    public function completedInvoices()

    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('Dashboard.Doctors.invoices.completed_invoices', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Ray::findorFail($id);
        if ($rays->doctor_id != auth()->user()->id) {
            //abort(404);
            return redirect()->route('404');
        }
        return view('Dashboard.Doctors.invoices.view_rays', compact('rays'));
    }
}
