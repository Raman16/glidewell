<?php

namespace App\Http\Controllers\QuestionManagement;

use App\Http\Controllers\Controller;
use App\Modules;
use App\Quiz;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionsCategoryController extends Controller
{
    public function index() {

       
        try 
        {
             $quiz_count=DB::table('quiz')->count();
             $practice_quiz_count= DB::table('practise_exams')->count();
                

            $questions_mgmt=[];
            $questions_mgmt[0]['sno']=1;
            $questions_mgmt[0]['category']='quiz';
            $questions_mgmt[0]['no_question']=$quiz_count;
    
            $questions_mgmt[1]['sno']=2;
            $questions_mgmt[1]['category']='practise quiz';
            $questions_mgmt[1]['no_question']=$practice_quiz_count;
            return view('questions.category',['question_category'=>$questions_mgmt]);
        }
        catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }
      
     
     
        
    }
}