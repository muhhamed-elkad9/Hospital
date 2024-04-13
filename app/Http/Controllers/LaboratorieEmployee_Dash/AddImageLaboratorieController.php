<?php

namespace App\Http\Controllers\LaboratorieEmployee_Dash;

use App\Http\Controllers\Controller;
use App\Models\LaboratorieEmployee;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageLaboratorieController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $LaboratorieEmployee = LaboratorieEmployee::find(Auth::user()->id);
        if (!$LaboratorieEmployee)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('laboratorie_employee')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Laboratorie/' . Auth::user()->id);

                $LaboratorieEmployee->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('Dashboard/img/profile/Laboratorie/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $LaboratorieEmployee->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('Dashboard/img/profile/Laboratorie/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Laboratorie/' . Auth::user()->id);

                $LaboratorieEmployee->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        session()->flash('edit');
        return redirect()->back();
    }
}
