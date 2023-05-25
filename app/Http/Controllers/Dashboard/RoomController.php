<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::where('user_id',auth()->user()->id)->with('exam')->simplePaginate(5);
        return view('dashboard.rooms.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams  = Exam::where('user_id',auth()->user()->id)->get();
        return view('dashboard.rooms.create', compact('exams'));
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
            'password'  => 'required',
            'exam_id'  => 'required|exists:exams,id',
        ]);

        try{
            $data = $request->except('_token');
            $data['user_id'] = auth()->user()->id;
            Room::create($data);

            session()->flash('success', 'تم الاضافه بنجاح');
            return redirect()->route('room.index');

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
        $room = Room::where('user_id',auth()->user()->id)->with('exam')->find($id);
        $exams  = Exam::where('user_id',auth()->user()->id)->get();
        return view('dashboard.rooms.edite', compact('room', 'exams'));
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
            'password'  => 'required',
            'exam_id'  => 'required|exists:exams,id',
        ]);

        try{

            $room =  Room::find($id);

            $data = $request->except('_token');

            $room->update($data);

            session()->flash('success', 'تم التعديل بنجاح');

            return redirect()->route('room.index');

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
            $room =  Room::find($id);

            if(!$room)
            {
                return redirect()->back()->with(['error'=>'لا يوجد']);
            }

            $room->delete();

            session()->flash('success', 'تم الحذف بنجاح');

            return redirect()->route('room.index');

        }catch(\Exception $e){

            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }
}
