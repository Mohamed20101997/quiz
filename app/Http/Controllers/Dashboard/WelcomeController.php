<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Home;
use App\Models\HomeReserve;
use App\Models\Owners;
use App\Models\Question;
use App\Models\Room;
use App\Models\Subject;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        $user = \App\Models\User::where('id',auth()->user()->id)->first();
        if($user->role == 'ادمن'){
            $subjects =  Subject::get()->count();
            $exams =  Exam::get()->count();
            $questions =  Question::get()->count();
            $rooms =  Room::get()->count();
        }else{
            $subjects =  Subject::where('user_id',auth()->user()->id)->get()->count();
            $exams =  Exam::where('user_id',auth()->user()->id)->get()->count();
            $questions =  Question::where('user_id',auth()->user()->id)->get()->count();
            $rooms =  Room::where('user_id',auth()->user()->id)->get()->count();
        }


        return view('dashboard.welcome',compact('subjects','exams','questions','rooms'));

    } //end of index

} //end of controller
