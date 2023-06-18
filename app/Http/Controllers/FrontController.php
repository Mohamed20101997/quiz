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


    public function getExam(Request $request){


        $request->validate([
            'room_id'  => 'required|exists:rooms,password',
            'user_id' => 'required|exists:users,id',
            'exam_id' => 'required|exists:exams,id'
        ],[
            'room_id.required'=> 'يجب ادخال رقم الغرفة',
            'room_id.exists'=> 'رقم خاطئ او غير موجود',
            'user_id.required'=> 'يجب اختيار مدرس ',
            'user_id.exists'=> 'مدرس غير موجود',
            'exam_id.required'=> 'يجب اختيار امتحان ',
            'exam_id.exists'=> 'امتحان غير موجود',
        ]);


        try{

            $room = Room::where([['password', $request->room_id],['user_id',$request->user_id],['exam_id' , $request->exam_id]])->first();
            if($room){
                $exam = Exam::where('id',$room->exam_id)->with('subject')->first();
                

            }

        }catch(\Exception $e){

            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }



}
