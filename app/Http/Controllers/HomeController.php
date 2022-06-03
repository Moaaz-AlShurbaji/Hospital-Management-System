<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype == '0')
            {
                $user = Auth::User()->id;
                $doctors = Doctor::all();
                return view('user.home',compact('doctors','user'));
            }
            else
            {
                return view('admin.home');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

    public function index()
    {
        if(Auth::id())
        {
            return redirect('/home');
        }
        $doctors = Doctor::all();
        #dd($doctors);
        return view('user.home',compact('doctors'));
    }

    public function appointment(Request $request)
    {
        $user_id = null;

        if(Auth::id())
        {
            $user_id = Auth::user()->id;
        }

        Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'doctor' => $request->doctor,
            'date' => $request->date,
            'message' => $request->message,
            'status' => "In Progress",
            'user_id' => $user_id
        ]);
        return redirect()->back()->with('message','Appointment submitted successfuly');
    }

    public function view_appointments($user_id)
    {
        if($user_id != Auth::user()->id)
        {
            return redirect()->back();
        }
        $appointments = Appointment::where('user_id',$user_id)->get();
        return view('user.my_appointments',compact('appointments'));
    }

    public function delete_appointment($appointment_id)
    {
        $appointment = Appointment::FindOrFail($appointment_id);
        $appointment->delete();
        return redirect()->back();
    }
}
