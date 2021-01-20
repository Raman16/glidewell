<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modules extends Model
{
    //
    use SoftDeletes;

    public function flashCards(){
        return $this->hasMany('App\FlashCards','module_id');
    }
}
