<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function questionSubject(){
        return $this->hasMany(questionSubject::class, 'subject_id', 'id');
    }
}
