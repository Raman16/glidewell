<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\QuizAttempted;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function showQuizzes(Request $request)
    {
         $user_id=$request->user_id;
        // $quiz_attempted=QuizAttempted::where('user_id',$user_id)->get();
         //print_r($quiz_attempted->isEmpty());die;
           $response=[];
         //if(!$quiz_attempted->isEmpty()){
            $user_quest=DB::select('select q.*,uqs.is_attempted,uqs.is_correct from quiz as q
                       left join user_quiz_submit AS uqs 
                         on q.id=uqs.question_id and uqs.user_id='.$user_id);
              //  $user_quest=statement($user_quest1);        

            // DB::table('quiz AS q')
            //                 ->leftJoin('user_quiz_submit AS uqs', function($join) use($user_id) {
            //                     $join->on('q.id', '=', 'uqs.question_id')
            //                     ->on('uqs.user_id', '=', DB::raw($user_id));
            //                     })
            //                 ->select('q.*','uqs.is_attempted','uqs.is_correct')
            //                 ->get();

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
    public function quizattempted(Request $request){

         $quiz_attempted=QuizAttempted::where('user_id',$request->user_id)
                                       ->where('question_id',$request->question_id)->get();

         if(!$quiz_attempted->isEmpty()){

            QuizAttempted::where('user_id',$request->user_id)
                         ->where('question_id',$request->question_id)
                         ->update(['is_attempted'=>'yes',
                                   'is_correct'=>$request->is_correct,
                                    'max_attempts'=>$quiz_attempted[0]['max_attempts']+1]);

             $res=QuizAttempted::where('user_id',$request->user_id)
                                    ->where('question_id',$request->question_id)->get();
            return response()->json($res);
         }else{

            $quiz=new QuizAttempted;
            $quiz->is_attempted='no';
            $quiz->is_correct=$request->is_correct;
            $quiz->user_id=$request->user_id;
            $quiz->question_id=$request->question_id;
            $quiz->max_attempts=1;
            $quiz->save();
            return response()->json($quiz);
         }
         
    }
}
