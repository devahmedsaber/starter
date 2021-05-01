<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Phone;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    // One To One Methods
    public function hasOneRelation(){
        $user = User::with(['phone' => function($q){
            $q->select('code', 'phone', 'user_id');
        }])->find(1);
        // $phone = $user->phone;
        //return $user->phone->code;
        //return $user->name;
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
        //$phone = Phone::find(1);
        // Make Some Attributes Visible
        //$phone->makeVisible(['user_id']);
        // Make Some Attributes Hidden
        //$phone->makeHidden(['user_id']);
        // Return User Of This Phone Number
        //$phone->user;
        // Get All Data Phone + User Data
        //$phone = Phone::with('user')->find(1);
        $phone = Phone::with(['user' => function ($q){
            $q->select('id', 'email');
        }])->find(1);
        return $phone;
    }

    public function getUserHasPhones(){
        $user = User::whereHas('phone')->get();
        return $user;
    }

    public function getUserDoesntHavePhones(){
        $user = User::whereDoesntHave('phone')->get();
        return $user;
    }

    public function getUserHasPhonesWithCond(){
        $user = User::whereHas('phone', function ($q){
            $q->where('code', '02');
        })->get();
        return $user;
    }

    // One To Many Methods
    public function getHospitalDoctors(){
        $hospital = Hospital::with(['doctors'])->find(1);
        // Return First Hospital
        // Hospital::where('id', 1)->first();
        // Hospital::first();
        // Return Doctors Of Hospital
        // $hospital->doctors;
        // Return Hospital Name
        // $hospital->name;
        $doctors = $hospital->doctors;
        foreach ($doctors as $doctor)
            echo $doctor->name . '<br>';
        $doctor = Doctor::find(3);
        return $doctor->hospital->name;
    }

    public function hospitals(){
        $hospitals = Hospital::select('id', 'name', 'address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors', compact('doctors'));
    }

    public function hospitalsHasDoctors(){
        // Get All Hospitals That Has Doctors
        return Hospital::whereHas('doctors')->get();
    }

    public function hospitalsHasMaleDoctors(){
        // Get All Hospitals Has Male Doctors With Doctors
        return Hospital::with('doctors')->whereHas('doctors', function ($q){
            $q->where('gender', '1');
        })->get();
    }

    public function hospitalsNotHasDoctors(){
        // Get All Hospitals That Not Have Doctors
        return Hospital::whereDoesntHave('doctors')->get();
    }

    public function deleteHospital($hospital_id){
        // OTM Relationship - Delete Hospital And All Doctors That In It.
        $hospital = Hospital::find($hospital_id);
        if (!$hospital)
            return abort('404');
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospitals.all');
    }
}








