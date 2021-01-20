<?php

namespace App\Http\Controllers\Api\PractiseExams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\PractiseExams;
use App\PractiseExamsAttempted;

class PractiseQuestionController extends Controller
{
    public function showPractiseExams()
    {
      
         $user_id=Auth::id(); 
     
           $response=[];
         
            $user_quest= DB::table('practise_exams AS pe')
                            ->leftJoin('practise_exams_submit AS pes', function($join) use($user_id) {
                                $join->on('pe.id', '=', 'pes.question_id')
                                ->on('pes.user_id', '=', DB::raw($user_id));
                                })           
                            ->leftJoin('videos AS vd', 'pe.video_id', '=', 'vd.id')
                            ->select('pe.*','pes.is_attempted','pes.is_correct','vd.*')
                            ->get();
             foreach ($user_quest as $quest) {
                $uq=[];
              foreach ($quest as $column=>$value) {
                  $uq[$column]=$value;
                  if($column=='is_attempted' && 
                      ($uq[$column]=='' || $uq[$column]==null)){
                    $uq['is_attempted']='no';
                  }
              }
              $response[]=$uq;
          
          }
            return response()->json($response);
        // }
        // return response()->json(Quiz::all());

    }
    public function practiseExamsAttempted(Request $request){

         $practise_exams_attempted=PractiseExamsAttempted::where('user_id',$request->user_id)
                                       ->where('question_id',$request->question_id)->get();

         if(!$practise_exams_attempted->isEmpty()){

            PractiseExamsAttempted::where('user_id',$request->user_id)
                         ->where('question_id',$request->question_id)
                         ->update(['is_attempted'=>'yes',
                                   'is_correct'=>$request->is_correct,
                                    'max_attempts'=>$quiz_attempted[0]['max_attempts']+1]);
                                    
             $res=PractiseExamsAttempted::where('user_id',$request->user_id)
                                    ->where('question_id',$request->question_id)->get();
            return response()->json($res);
         }else{

            $practise_exams=new PractiseExamsAttempted;
            $practise_exams->is_attempted='no';
            $practise_exams->is_correct=$request->is_correct;
            $practise_exams->user_id=$request->user_id;
            $practise_exams->question_id=$request->question_id;
            $practise_exams->max_attempts=1;
            $practise_exams->save();
            return response()->json($practise_exams);
         }
         
    }
}
