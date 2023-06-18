<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Room;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(){
         $teachers =  User::where('role' , 'teacher')->whereHas('subjects')->get();
        return view('welcome' , compact('teachers'));
    }



    public function login(Request $request){
        $check = User::where([['email',$request->input("email")],['role','student']])->first();

        if($check){
            if(auth()->guard('student')->attempt(['email'=> $request->input("email") ,'password' =>  $request->input("password")]))
            {
                return redirect()->route('home');
            }
        }

        return \Redirect::back()->withErrors(['msg' => 'الرقم السري او البرد الالكتروني غير صحيحين']);
    }


    public function logout(){
        auth()->guard('student')->logout();
        return redirect()->route('home');

    }


    public function getSubjects($id){
        $subjects = Subject::where('user_id',$id)->get();
        if(count($subjects) > 0){
            $html = view('options.subjects' , compact('subjects'))->render();
            return response()->json($html);
        }
    }



    public function getExams($id){
        $exams = Exam::where('subject_id',$id)->get();
        if(count($exams) > 0){
            $html = view('options.exams' , compact('exams'))->render();
            return response()->json($html);
        }
    }


    public function getRooms($id){
        $room = Room::where('exam_id',$id)->first();


            $html = view('options.rooms' , compact('room'))->render();
            return response()->json($html);

    }




}
