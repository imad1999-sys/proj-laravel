<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Mobile;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = \App\User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(9);
        return $user -> phone -> code;
        return response() -> json($user);
    }
    public function hasOneRelationReverse(){
        $phone = Mobile::find(1);
        $phone -> makeVisible(['user_id']);
        $phone -> user;
        return $phone;
    }
    public function getUsersHasPhone(){
        return User::whereHas('phone')->get();
    }
    public function getUsersNotHasPhone(){
        return User::whereDoesntHave('phone')->get();
    }
    public function getHospitalDoctors(){
       $hospital =  Hospital::with('doctors')->find(1);
       $doctors = $hospital -> doctors;
       /*foreach ($doctors as $doctor){
           echo $doctor -> name .'<br>';
       }*/
       $doctor = Doctor::find(3);

       return $doctor -> hospital -> name;
    }
    public function getHospitals(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('Doctors.hospital',compact('hospitals'));
    }
    public function getDoctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctor = $hospital -> doctors;
        return view('Doctors.doctor',compact('doctor'));
    }
    public function getHospitalsHasDoctors(){
        return $hospital = Hospital::whereHas('doctors')->get();
    }
    public function getHospitalsHasDoctorsMale(){
        return $hospital = Hospital::whereHas('doctors',function ($q){
            $q -> where('gender' , 1);
        })->get();
    }
    public function getHospitalsNotHaveDoctor(){
        return $hospital = Hospital::whereDoesntHave('doctors')->get();
    }
}
