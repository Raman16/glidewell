<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlashCards extends Model
{

    //checks below modules_id in table as module()
    use SoftDeletes;
    public function module(){
        return $this->belongsTo('App\Modules');
    }
}
