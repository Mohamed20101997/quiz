<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('user')->simplePaginate(5);
        return view('dashboard.subjects.index',compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::where('role','teacher')->get();
        return view('dashboard.subjects.create', compact('users'));
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
            'name'  => 'required',
            'user_id'  => 'required|exists:users,id',
        ]);

        try{
            $data = $request->except('_token');

            Subject::create($data);

            session()->flash('success', 'تم الاضافه بنجاح');
            return redirect()->route('subject.index');

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
        $subject = Subject::with('user')->find($id);
        $users  = User::where('role','teacher')->get();
        return view('dashboard.subjects.edite', compact('subject', 'users'));
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
            'name'   => 'required',
            'user_id'  => 'required|exists:users,id',
        ]);

        try{

            $subject =  Subject::find($id);

            $data = $request->except('_token');

            $subject->update($data);

            session()->flash('success', 'تم التعديل بنجاح');

            return redirect()->route('subject.index');

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
            $subject =  Subject::find($id);

            if(!$subject)
            {
                return redirect()->back()->with(['error'=>'لا يوجد مستخدمين']);
            }

            $subject->delete();

            session()->flash('success', 'تم الحذف بنجاح');

            return redirect()->route('subject.index');

        }catch(\Exception $e){

            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }
}
