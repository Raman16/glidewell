<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PractiseExam extends Model
{
    use SoftDeletes;
    public $table='practise_exams';
   
}
