<?php

namespace App\Http\Controllers\LaboratorieEmployee_Dash;

use App\Http\Controllers\Controller;
use App\Models\Ray;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class invoicesController extends Controller
{
    use UploadTrait;

    public function index()
    {
        return 1;
    }

    public function edit($id)
    {
        $invoice = Ray::findorFail($id);
        return view('Dashboard.ray_employee.invoices.add_diagnosis', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Ray::findorFail($id);

        $invoice->update([
            'employee_id' => auth()->user()->id,
            'description_employee' => $request->description_employee,
            'case' => 1,
        ]);


        if ($request->hasFile('photos')) {

            foreach ($request->photos as $photo) {
                //Upload img
                $this->verifyAndStoreImageForeach($photo, 'Rays', 'upload_image', $invoice->id, 'App\Models\Ray');
            }
        }
        session()->flash('edit');
        return redirect()->route('invoices_ray_employee.index');
    }

    // قائمة الفواتير المكتملة
    public function completed_invoices()
    {
        $invoices = Ray::where('case', 1)->where('employee_id', auth()->user()->id)->get();
        return view('Dashboard.ray_employee.invoices.completed_invoices', compact('invoices'));
    }

    public function view_rays($id)
    {
        $rays = Ray::findorFail($id);
        if ($rays->employee_id != auth()->user()->id) {
            //abort(404);
            return redirect()->route('404');
        }
        return view('Dashboard.ray_employee.invoices.patient_details', compact('rays'));
    }
}
