<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::where('user_id',auth()->user()->id)->with('subject')->simplePaginate(5);
        return view('dashboard.exams.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects  = Subject::where('user_id',auth()->user()->id)->get();
        return view('dashboard.exams.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required',
            'duration'  => 'required',
            'degree'  => 'required',
            'subject_id'  => 'required|exists:subjects,id',
        ]);

        try{
            $data = $request->except('_token');
            $data['user_id'] = auth()->user()->id;
            Exam::create($data);

            session()->flash('success', 'تم الاضافه بنجاح');
            return redirect()->route('exam.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::where('user_id',auth()->user()->id)->with('subject')->find($id);
        $subjects  = Subject::where('user_id',auth()->user()->id)->get();
        return view('dashboard.exams.edite', compact('exam', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required',
            'duration'  => 'required',
            'degree'  => 'required',
            'subject_id'  => 'required|exists:subjects,id',
        ]);

        try{

            $exam =  Exam::find($id);

            $data = $request->except('_token');

            $exam->update($data);

            session()->flash('success', 'تم التعديل بنجاح');

            return redirect()->route('exam.index');

        }catch(\Exception $e){
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $exam =  Exam::find($id);

            if(!$exam)
            {
                return redirect()->back()->with(['error'=>'لا يوجد مستخدمين']);
            }

            $exam->delete();

            session()->flash('success', 'تم الحذف بنجاح');

            return redirect()->route('exam.index');

        }catch(\Exception $e){

            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }
}
