<?php

namespace App\Http\Controllers\Api\Quizzes;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\QuizAttempted;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class QuizController extends Controller
{
  public function storeQuiz(Request $request)
    {
        
        $quiz=new Quiz;
        $this->authorize('update',$quiz);
        
        $quiz->question=$request->input('question');
        $quiz->options=$request->input('options');
        $quiz->option1=$request->input('option1');
        $quiz->option2=$request->input('option2');
        $quiz->option3=$request->input('option3');
        $quiz->option4=$request->input('option4');
        $quiz->option5=$request->input('option5');
        $quiz->answer=$request->input('answer');
        $quiz->video_link=$request->input('video_link');
        $quiz->video_title=$request->input('video_title');
        $quiz->video_description=$request->input('video_description');
        $quiz->save();
        return response()->json($card, 201);//need to pass module and flashcarrd
    }

    public function showQuizzes()
    {
      
         $user_id=Auth::id(); 
     
           $response=[];
         
            $user_quest= DB::table('quiz AS q')
                            ->leftJoin('user_quiz_submit AS uqs', function($join) use($user_id) {
                                $join->on('q.id', '=', 'uqs.question_id')
                                ->on('uqs.user_id', '=', DB::raw($user_id));
                                })           
                            ->leftJoin('videos AS vd', 'q.video_id', '=', 'vd.id')
                            ->select('q.*','uqs.is_attempted','uqs.is_correct','vd.*')
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