<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];


    public function exam(){
        return $this->belongsTo(Exam::class , 'exam_id','id');
    }

}
