<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id' ,'!=' , auth()->user()->id)->simplePaginate(5);
        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
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
            'email'  => 'required|email',
            'password'  => 'required|min:6|confirmed',
            'role'  => 'required',
        ]);

        try{
            $data = $request->except('_token');

            if(!empty($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }

            User::create($data);

            session()->flash('success', 'تم الاضافه بنجاح');
            return redirect()->route('user.index');

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
        $user = User::find($id);
        return view('dashboard.users.edite', compact('user'));
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
            'email'  => 'required|email|unique:users,email,'.$id,
            'name'   => 'required',
            'role' => 'required',
            'password' => 'sometimes|confirmed',
        ]);

        try{

            $user =  User::find($id);

            $data = $request->except('_token');

            if(!empty($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }else{
                $data['password'] = $user->password;
            }


            $user->update($data);

            session()->flash('success', 'تم التعديل بنجاح');

            return redirect()->route('user.index');

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
            $user =  User::find($id);

            if(!$user)
            {
                return redirect()->back()->with(['error'=>'لا يوجد مستخدمين']);
            }

            $user->delete();

            session()->flash('success', 'تم الحذف بنجاح');

            return redirect()->route('user.index');

        }catch(\Exception $e){

            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }
    }
}
