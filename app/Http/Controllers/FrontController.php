<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Room;
use App\Models\QuestionSubject;
use App\Models\Subject;
use App\Models\StudentProfile;
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

            $StudentProfile = StudentProfile::where([['user_id',auth()->guard('student')->user()->id],['exam_id' , $request->exam_id]])->first();
            if($StudentProfile)
            {
                 return response()->json(['status'=>'error' , 'message'=>'لقد قمت بإجراء هذا الامتحان من قبل']);
            }else{
                $room = Room::where([['password', $request->room_id],['user_id',$request->user_id],['exam_id' , $request->exam_id]])->first();
                if($room){
                    $exam = Exam::where('id',$room->exam_id)->with('subject')->first();

                    $html = view('exam' , compact('exam'))->render();
                    return response()->json($html);
                }
            }


        }catch(\Exception $e){

            return response()->json(['status'=>'error' , 'message'=>'هناك مشكلة']);
        }
    }

    public function results(Request $request){

        $exam_id = $request->exam_id;
        $subject_id = $request->subject_id;
        $data = $request->except('_token', '_method' , 'exam_id' , 'subject_id');
        $total =0;
        if(count($data) > 0)
        {
            foreach($data as $key => $result){

                $question = QuestionSubject::where([['subject_id',$subject_id],['question_id',$key]])->first();
                if($result == $question->answer){

                    $total += $question->degree;
                }
            }
        }

        StudentProfile::create([
            'user_id' => auth()->guard('student')->user()->id,
            'exam_id' => $exam_id,
            'degree' => $total,
        ]);


        return redirect()->route('profile');

    }



    public function profile(){
        $user_id = auth()->guard('student')->user()->id;

        $StudentProfile = StudentProfile::where('user_id',auth()->guard('student')->user()->id)->with('exam')->get();

        return view('profile' , compact('StudentProfile'));

    }

}
