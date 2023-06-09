<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSubject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];


    public function subject(){
        return $this->belongsTo(Subject::class , 'subject_id' , 'id');
    }


    public function question(){
        return $this->belongsTo(question::class , 'question_id' , 'id');
    }


}
