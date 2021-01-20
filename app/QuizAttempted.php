<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAttempted extends Model
{
    public $table="user_quiz_submit";
    protected $hidden=['max_attempts'];
    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
    public function user(){
        return $this->belongsTo(Quiz::class);
    }
}
