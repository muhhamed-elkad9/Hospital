<?php

namespace App\Http\Controllers\RayEmployee_Dash;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\RayEmployee;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageRayController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $RayEmployee = RayEmployee::find(Auth::user()->id);
        if (!$RayEmployee)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('ray_employee')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Ray/' . Auth::user()->id);

                $RayEmployee->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('Dashboard/img/profile/Ray/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $RayEmployee->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('Dashboard/img/profile/Ray/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Ray/' . Auth::user()->id);

                $RayEmployee->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        session()->flash('edit');
        return redirect()->back();
    }
}
