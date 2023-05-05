<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function questionSubject(){
        return $this->hasOne(QuestionSubject::class , 'question_id' , 'id');
    }

    public function mcq(){
        return $this->hasOne(Mcq::class , 'question_id' , 'id');
    }
}
