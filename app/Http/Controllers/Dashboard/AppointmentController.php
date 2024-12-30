<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmation;
use App\Models\Appointment;
use App\Notifications\AppointmetNotification;
use App\Notifications\DoctorNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{

    use Notifiable;
    public function index()
    {
        $appointments  = Appointment::where('type', 'غير مؤكد')->get();
        return view('Dashboard.appointments.index', compact('appointments'));
    }

    public function certain()
    {
        $appointments  = Appointment::where('type', 'مؤكد')->get();
        return view('Dashboard.appointments.index2', compact('appointments'));
    }

    public function done()
    {
        $appointments  = Appointment::where('type', 'منتهي')->get();
        return view('Dashboard.appointments.index3', compact('appointments'));
    }

    public function approval(Request $request, $id)
    {
        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->update([
                'type' => 'مؤكد',
                'appointment' => $request->appointment,
            ]);

            Notification::route('mail', $appointment->email)->notify(new AppointmetNotification($appointment));
            Notification::route('mail', $appointment->doctor->email)->notify(new DoctorNotification($appointment));

            //send email with mailgun
            //Mail::to($appointments->email)->send(new AppointmentConfirmation());


            session()->flash('add');
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Appointment::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
