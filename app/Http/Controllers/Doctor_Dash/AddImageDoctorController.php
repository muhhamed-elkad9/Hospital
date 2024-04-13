<?php

namespace App\Http\Controllers\Doctor_Dash;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageDoctorController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $Doctor = Doctor::find(Auth::user()->id);
        if (!$Doctor)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('doctor')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Doctor/' . Auth::user()->id);

                $Doctor->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('Dashboard/img/profile/Doctor/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $Doctor->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('Dashboard/img/profile/Doctor/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Doctor/' . Auth::user()->id);

                $Doctor->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        session()->flash('edit');
        return redirect()->back();
    }
}
