<?php

namespace App\Http\Controllers\Patient_Dash;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImagePatientController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $Patient = Patient::find(Auth::user()->id);
        if (!$Patient)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('patient')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Patient/' . Auth::user()->id);

                $Patient->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('Dashboard/img/profile/Patient/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $Patient->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('Dashboard/img/profile/Patient/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Patient/' . Auth::user()->id);

                $Patient->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        session()->flash('edit');
        return redirect()->back();
    }
}
