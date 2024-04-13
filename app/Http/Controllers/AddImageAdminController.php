<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\UploadImage;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AddImageAdminController extends Controller
{
    use UploadImage;

    public function update(Request $request)
    {

        $Admin = Admin::find(Auth::user()->id);
        if (!$Admin)
            return redirect()->back();

        //////////////// Table Admin
        if (auth('admin')->check()) {

            if ($request->photo == 'user_icon.png') {

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Admin/' . Auth::user()->id);

                $Admin->update([
                    'avatar' => $file_name,
                ]);
            }

            if ($request->photo == null) {
                File::delete(public_path('Dashboard/img/profile/Admin/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $Admin->update([
                    'avatar' => null,
                ]);
            } else {

                File::delete(public_path('Dashboard/img/profile/Admin/' . Auth::user()->id . '/' . Auth::user()->avatar));

                $file_name = $this->saveImage($request->photo, 'Dashboard/img/profile/Admin/' . Auth::user()->id);

                $Admin->update([
                    'avatar' => $file_name,
                ]);
            }
        }

        session()->flash('edit');
        return redirect()->back();
    }
}
