<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Mcq;
use App\Models\Question;
use App\Models\QuestionSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::simplePaginate(5);
        return view('dashboard.questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects  = Subject::get();
        return view('dashboard.questions.create', compact('subjects'));

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
            'answer'  => 'required',
            'degree'  => 'required',
            'type'  => 'required',
            'question'  => 'required',
            'choice_a' => 'required_if:type,==,mcq',
            'choice_b' => 'required_if:type,==,mcq',
            'choice_c' => 'required_if:type,==,mcq',
            'choice_d' => 'required_if:type,==,mcq',
            'subject_id'  => 'required|exists:subjects,id',
        ]);

        DB::beginTransaction();
        try{
            $data = $request->except('_token');

            $question = Question::create([
                'question' => $data['question'],
                'type' => $data['type'],
            ]);

            if($question){
                QuestionSubject::create([
                    'subject_id' => $data['subject_id'],
                    'question_id' => $question->id,
                    'answer' => $data['answer'],
                    'degree' => $data['degree'],
                ]);

                if($question->type == 'mcq'){
                    Mcq::create([
                        'choice_A' => $data['choice_a'],
                        'choice_B' => $data['choice_b'],
                        'choice_C' => $data['choice_c'],
                        'choice_D' => $data['choice_d'],
                        'question_id' => $question->id,
                    ]);
                }
            }
            DB::commit();
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
        $subjects  = Subject::get();
        $question = Question::findOrFail($id);
        return view('dashboard.questions.edite', compact('subjects','question'));
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
            'answer'  => 'required',
            'degree'  => 'required',
            'type'  => 'required',
            'question'  => 'required',
            'choice_a' => 'required_if:type,==,mcq',
            'choice_b' => 'required_if:type,==,mcq',
            'choice_c' => 'required_if:type,==,mcq',
            'choice_d' => 'required_if:type,==,mcq',
            'subject_id'  => 'required|exists:subjects,id',
        ]);

        DB::beginTransaction();
        try{
            $data = $request->except('_token');

            $question = Question::findOrFail($id);

            $question->update([
                'question' => $data['question'],
                'type' => $data['type'],
            ]);

            if($question){
                QuestionSubject::where('question_id', $question->id)->update([
                    'subject_id' => $data['subject_id'],
                    'answer' => $data['answer'],
                    'degree' => $data['degree'],
                ]);

                if($question->type == 'mcq'){
                    Mcq::where('question_id', $question->id)->update([
                        'choice_a' => $data['choice_a'],
                        'choice_b' => $data['choice_b'],
                        'choice_c' => $data['choice_c'],
                        'choice_d' => $data['choice_d'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('success', 'تم التعديل بنجاح');
            return redirect()->route('question.index');

        }catch(\Exception $e){
            DB::rollback();
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

        DB::beginTransaction();
        try{
            $question = Question::findOrFail($id);

            if($question){
                $question->delete();

                QuestionSubject::where('question_id', $id)->delete();

                if($question->type == 'mcq'){
                    Mcq::where('question_id', $id)->delete();
                }
            }
            DB::commit();
            session()->flash('success', 'تم الحذف بنجاح');
            return redirect()->route('question.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['error'=>'هناك مشكله']);
        }

    }
}
