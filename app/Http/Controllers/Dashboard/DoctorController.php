<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorsRequest;
use App\Models\Appointment;
use App\Models\Dates;
use App\Models\Datework;
use App\Models\datework_doctor;
use App\Models\Doctor;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::all();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }


    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        $Dates = Datework::all();
        return view('Dashboard.Doctors.create', compact('sections', 'appointments', 'Dates'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            // $doctors->dates = $request->dates;
            $doctors->number_of_statements = $request->number_of_statements;
            $doctors->save();
            // store trans
            $doctors->name = $request->name;
            $doctors->save();

            // insert pivot tABLE
            $doctors->doctordateworks()->attach($request->dates);

            //Upload img
            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctors->id, 'App\Models\Doctor');


            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        // return $request;
    }

    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $sections = Section::all();
        $appointments = Appointment::all();
        $Dates = Datework::all();
        return view('Dashboard.Doctors.edit', compact('doctor', 'sections', 'appointments', 'Dates'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $doctor = Doctor::findorfail($request->id);
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->status = 1;
            $doctor->number_of_statements = $request->number_of_statements;
            $doctor->save();
            // store trans
            $doctor->name = $request->name;
            $doctor->save();

            // update pivot tABLE
            $doctor->doctordateworks()->sync($request->dates);

            // update photo
            if ($request->has('photo')) {
                // Delete old photo
                if ($doctor->image) {
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image', 'doctors/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $request->id, 'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->page_id == 1) {
            if ($request->filename) {
                $this->Delete_attachment('upload_image', 'doctors/' . $request->filename, $request->id);
            }

            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        } else {
            $delete_select_id = explode(',', $request->delete_select_id);

            foreach ($delete_select_id as $ids_doctors) {
                $doctor = Doctor::findorfail($ids_doctors);
                if ($doctor->image) {
                    $this->Delete_attachment('upload_image', 'doctors/' . $doctor->image->filename, $ids_doctors);
                }
            }
            Doctor::destroy($delete_select_id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }
    }

    public function update_password(Request $request)
    {
        DB::beginTransaction();

        try {

            $doctors = Doctor::find($request->id);
            $doctors->password = Hash::make($request->password);
            if ($request->password == $request->password_confirmation) {
                $doctors->save();
            }


            DB::commit();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update_status(Request $request)
    {
        DB::beginTransaction();

        try {

            $doctors = Doctor::find($request->id);

            if ($request->status == 0) {
                $doctors->status = 0;
            } elseif ($request->status == 1) {
                $doctors->status = 1;
            }
            $doctors->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
