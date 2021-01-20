<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QuizAttempted;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    
    use SoftDeletes;
    public $table='quiz';
    public function quizAttempted(){
        return $this->hasMany(QuizAttempted::class);
    }
}
