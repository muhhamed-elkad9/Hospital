<?php

namespace App\Http\Controllers\Dashboard\appointments;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

class AppointmentControllerr extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('type', 'غير مؤكد')->get();
        return view('Dashboard.appointments.index', compact('appointments'));
    }

    public function index2()
    {
        $appointments = Appointment::where('type', 'مؤكد')->get();
        return view('Dashboard.appointments.index2', compact('appointments'));
    }

    public function index3()
    {
        $appointments = Appointment::where('type', 'منتهي')->get();
        return view('Dashboard.appointments.index3', compact('appointments'));
    }

    public function approval(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $appointment = Appointment::find($id);
            $appointment->type = 'مؤكد';
            $appointment->appointment = $request->appointment;
            $appointment->save();

            // send email
            Mail::to($appointment->email)->send(new AppointmentConfirmation($appointment->name, $appointment->appointment));


            // send message mob
            $receiverNumber = '+16592157987';
            $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message
            ]);

            DB::commit();
            session()->flash('add');
            return redirect()->route('appointments.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Appointment::find($id)->delete();
        session()->flash('delete');
        return redirect()->route('appointments.index');
    }
}
