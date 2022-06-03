<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Http\Requests\DoctorRequest;
use Notification;
use App\Notifications\AppointmentNotification;

class AdminController extends Controller
{
    public function add_doctors_view()
    {
        return view('admin.add_doctor');
    }

    public function upload(DoctorRequest $request)
    {
        $image = null;
        
        /* I moved validation to the DoctorRequest file */
        /*$request->validate([
            'name' => 'required',
            'phone' => 'required',
            'speciality' => 'required',
            'room' => 'required'
        ]);*/

        if($request['image'])
        {
            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('doctor_image',$imageName);
            $image = $imageName;
        }
        

        Doctor::Create([
            'name' => $request->name,
            'phone' => $request->phone,
            'speciality' => $request->speciality,
            'room' => $request->room,
            'image' => $image
        ]);

        return redirect()->back()->with("message","Doctor Added Successfuly");
    }

    public function view_appointment()
    {
        //get only in progress appointments
        //$appointments = Appointment::where('status','In Progress')->get();
        $appointments = Appointment::all();
        return view('admin.show_appointments',compact('appointments'));
    }

    public function approve_appointment($appointment_id)
    {
        $appointment = Appointment::FindOrFail($appointment_id);
        $appointment -> status = "Approved";
        $appointment -> save();
        return redirect() -> back();
    }

    public function cancel_appointment($appointment_id)
    {
        $appointment = Appointment::FindOrFail($appointment_id);
        $appointment -> status = "Canceled";
        $appointment -> save();
        return redirect() -> back();
    }

    public function view_doctors()
    {
        $doctors = Doctor::all();
        return view('admin.all_doctors',compact('doctors'));
    }

    public function doctor_update($doctor_id)
    {
        $doctor = Doctor::FindOrFail($doctor_id);
        return view('admin.update_doctor',compact('doctor'));
    }

    public function edit_doctor(DoctorRequest $request, $doctor_id)
    {
        $doctor = Doctor::FindOrFail($doctor_id);
        $doctor -> name = $request -> name;
        $doctor -> phone = $request -> phone;
        $doctor -> speciality = $request -> speciality;
        $doctor -> room = $request -> room;
        $image = $request->file;
        if($image)
        {
            $imageName = time().'.'.$image->getClientoriginalExtention();
            $request->file->move('doctor_image',$imageName);
            $doctor -> image = $imageName;
        }
        
        $doctor -> save();
        return redirect() -> back() -> with('message','Doctor edited successfully');
    }

    public function delete_doctor($doctor_id)
    {
        $doctor = Doctor::FindOrFail($doctor_id);
        $doctor->delete();
        return redirect() -> back();
    }

    public function view_mail($appointment_id)
    {
        $appointment = Appointment::FindOrFail($appointment_id);
        return view('admin.email_view',compact('appointment'));
    }

    public function send_mail(Request $request, $appointment_id)
    {
        $appointment = Appointment::FindOrFail($appointment_id);
        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionURL' => $request->actionURL,
            'endpart' => $request->endpart
        ];

        Notification::send($appointment, new AppointmentNotification($details));

        return redirect() -> back() -> with('Message','Notifiaction sent successfully');
    }

}
