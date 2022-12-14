<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class HomepageController extends Controller
{
    public function redirect()
    {
      if(Auth::id())
      {
        if(Auth::user()->usertype=='0')
        {
          $doctor = doctor::all();
          return view('user.homepage',compact('doctor'));
        }
        else {
          return  view('admin.homepage');
        }
      }
      else{
        return redirect()->back();
      }
    }

    public function index()
    {

      if(Auth::id())
      {
        return redirect('homepage');

      }

      else{


      $doctor = doctor::all();


      return view('user.homepage',compact('doctor'));

    }
    }
    public function appointment(Request $request)
    {

      $data = new appointment;

      $data->name=$request->name;

      $data->email=$request->email;
      $data->date=$request->date;
      $data->phone=$request->phone;
      $data->message=$request->message;
      $data->doctor=$request->doctor;
      $data->status='In progress';

      if(Auth::id())
      {


       $data->user_id=Auth::user()->id;
      }

      $data->save();

      return redirect()->back()->with('message','Appointment Request Successful. We will contact with you soon');



    }

    public function myappointment()
    {

          return view('user.my_appointment');
    }


}
