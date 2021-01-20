<?php

namespace App\Http\Controllers\QuestionManagement;

use App\Http\Controllers\Controller;
use App\Modules;
use App\PractiseExam;
use App\Quiz;
use App\Videos;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuestionsMgtController extends Controller
{

    

    public function index(Request $request,$id) {
        
      

        if($id=='quiz'){
           
             if ($request->ajax()) {
              return DataTables()->of(Quiz::select('*')->withTrashed())
              ->addColumn('options', 'questions.options')
              ->addColumn('action', 'questions.action')
              ->addColumn('answer', 'questions.answer')
              ->rawColumns(['options','action'])
                ->addIndexColumn()
                ->make(true);
              }

              
              return view('questions.questions_list',['category'=>$id]);
        }else{
            

            if ($request->ajax()) {
                return DataTables()->of(PractiseExam::select('*'))
                ->addColumn('options', 'questions.options')
                ->addColumn('action', 'questions.action')
                ->addColumn('answer', 'questions.answer')
                ->rawColumns(['options','action'])
                  ->addIndexColumn()
                  ->make(true);
                }
                return view('questions.questions_list',['category'=>$id]);
        }
       
    }

    public function show($category,$id)
    {
 
        if($category=='quiz'){
            $data=DB::table('quiz AS q')
            ->leftJoin('videos AS v','q.video_id', '=', 'v.id')
                ->select('q.*','v.video_title','v.video_link','v.video_description')
                ->where('q.id',$id)
            ->get();
            return view('questions.question_form',['data'=>$data,'category'=>$category]);

        }
        else{
               $data=PractiseExam::leftJoin('videos', 'practise_exam.video_id', '=', 'videos.id')
                  ->where('practise_exam.id', $id)
                  ->get(['practise_exam.*', 'videos.video_link','videos.video_title','videos.video_description']);
                return view('questions.question_form',['data'=>$data,'category'=>$category]);
        }

    }
    public function store(Request $request,$category)
    {

        $data=$request->input('data');
       

        if($category=='quiz'){

            
            try{

                $video=new Videos();
                $video->video_title=$data['video_title'];
                $video->video_link=$data['video_url'];
                $video->video_description=$data['video_description'];
                $video->category_name='Quiz';
                $video->save();
                }catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
            }

            try {

                $quiz=new Quiz();
                    $quiz->question=$data['question'];
                $quiz->answer=$data['answer'];
                $quiz->opt1=$data['opt1'];
                $quiz->opt2=$data['opt2'];
                $quiz->opt3=$data['opt3'];
                $quiz->opt4=$data['opt4'];
                $quiz->opt5=$data['opt5'];
                $quiz->options=$data['no_of_options'];
                $quiz->video_id=$video->id;
                $quiz->save();
                return response()->json($quiz, 201);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
                    }

        }

        else{


            try{

                $video=new Videos();
                $video->video_title=$data['video_title'];
                $video->video_link=$data['video_url'];
                $video->video_description=$data['video_description'];
                $video->category_name='Practise Quiz';
                $video->save();
                }catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
            }

            
            try {

                $quiz=new PractiseExam();
                    $quiz->question=$data['question'];
                $quiz->answer=$data['answer'];
                $quiz->opt1=$data['opt1'];
                $quiz->opt2=$data['opt2'];
                $quiz->opt3=$data['opt3'];
                $quiz->opt4=$data['opt4'];
                $quiz->opt5=$data['opt5'];
                $quiz->options=$data['no_of_options'];
                $quiz->video_id=$video->id;
                $quiz->save();
                return response()->json($quiz, 201);
                } catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
                    }

        }
    }




    public function update(Request $request,$category)
    {
        
                $data=$request->input('data');

                 //For Update Existing Video Link  Below Code
                try{

                    if($data['video_id']!=0){

                       
                        $video=Videos::findOrFail($data['video_id']);
                        $video->video_title=$data['video_title'];
                        $video->video_link=$data['video_url'];
                        $video->video_description=$data['video_description'];
                        $video->save();

                     }else{
                        if($data['video_title']!='' || 
                           $data['video_url']!='' || 
                           $data['video_description']!='')
                           {
                                $video=new Videos();
                                $video->video_title=$data['video_title'];
                                $video->video_link=$data['video_url'];
                                $video->video_description=$data['video_description'];
                                $video->category_name=($category=='quiz')?'Quiz':'Practise Quiz';
                                $video->save();
                           }
                        
                     }
                }
                catch(\Illuminate\Database\QueryException $ex){ 
                            dd($ex->getMessage()); 
                            // Note any method of class PDOException can be called on $ex.
                }

              
            

        if($category=='quiz'){

            
            try {

                $quiz=Quiz::findOrFail($data['question_id']);
                $quiz->question=$data['question'];
                $quiz->answer=$data['answer'];
                $quiz->opt1=$data['opt1'];
                $quiz->opt2=$data['opt2'];
                $quiz->opt3=$data['opt3'];
                $quiz->opt4=$data['opt4'];
                $quiz->opt5=$data['opt5'];
                $quiz->options=$data['no_of_options'];
                $quiz->video_id=$video->id;
                $quiz->save();
                return response()->json($quiz, 201);

                } catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
                    }

            }

          else{

            
            try {

                $quiz= PractiseExam::findOrFail($data['question_id']);;
                $quiz->question=$data['question'];
                $quiz->answer=$data['answer'];
                $quiz->opt1=$data['opt1'];
                $quiz->opt2=$data['opt2'];
                $quiz->opt3=$data['opt3'];
                $quiz->opt4=$data['opt4'];
                $quiz->opt5=$data['opt5'];
                $quiz->options=$data['no_of_options'];
                if($data['video_id']==''){
                    $quiz->video_id=$video->id;
                }
                $quiz->save();
                return response()->json($quiz, 201);

                } catch(\Illuminate\Database\QueryException $ex){ 
                    dd($ex->getMessage()); 
                    // Note any method of class PDOException can be called on $ex.
                    }

        }

    }

    

    public function enableDisable(Request $request,$category)
    {

        $status=$request->input('data')['status'];
        $id=$request->input('data')['id'];
        if($category=='quiz'){
 
            if($status=='enable'){
                $quiz=Quiz::findOrFail($id);
                try{
                    $quiz->delete();
                    return response()->json(['message'=>'Deleted Successfully',201]);
                }
                catch(\illuminate\Database\QueryException $e){
                    dd($e->getMessage());
                }
            }
            else{

                $quiz=Quiz::where('id',$id)->withTrashed()->first();
                try{
                    $quiz->restore();
                    return response()->json(['message'=>'Deleted Successfully',201]);
                }
                catch(\illuminate\Database\QueryException $e){
                    dd($e->getMessage());
                }
            }
           
        }
       else{
                    if($status=='enable'){
                        $quiz=PractiseExam::findOrFail($id);
                        try{
                            $quiz->delete();
                            return response()->json(['message'=>'Deleted Successfully',201]);
                        }
                        catch(\illuminate\Database\QueryException $e){
                            dd($e->getMessage());
                        }
                    }
                    else{

                        $quiz=PractiseExam::where('id',$id)->withTrashed()->first();
                        try{
                            $quiz->restore();
                            return response()->json(['message'=>'Deleted Successfully',201]);
                        }
                        catch(\illuminate\Database\QueryException $e){
                            dd($e->getMessage());
                        }
                    }
        }
       

       
    }

}
