<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function teacherReport(){

        $teachers = User::where('role','teacher')->paginate(10);

        return view('dashboard.reports.teachers', compact('teachers'));
    }

    public function studentReport(){

        $auth = auth()->user();

        $students = '';
        if($auth->role == 'ادمن'){
            $students = StudentProfile::paginate(10);
        }elseif($auth->role == 'مدرس'){

            $students = StudentProfile::whereHas('exam' , function($q) use ($auth){
                $q->where('user_id', $auth->id);
            })->paginate(10);
        }

        return view('dashboard.reports.students', compact('students'));
    }

}
