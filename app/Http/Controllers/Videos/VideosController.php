<?php

namespace App\Http\Controllers\Videos;

use App\Http\Controllers\Controller;
use App\PractiseExam;
use App\Quiz;
use App\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideosController extends Controller
{
    
    public function index(Request $request){

       $videos= DB::table('videos AS v')
            ->leftJoin('quiz AS q','q.video_id', '=', 'v.id')
            ->leftJoin('practise_exams AS pq','pq.video_id', '=', 'v.id')
            ->select('v.*','q.id as quiz_id','pq.id as practise_id')
            ->get();

      
        if ($request->ajax()) {
              return DataTables()->of($videos)
            ->addColumn('question_id', function($videos) {
                if($videos->quiz_id!='') return '#Quiz'.$videos->quiz_id;
                if($videos->practise_id!='') return '#PQ'.$videos->practise_id;
            })
           ->addColumn('action', 'videos.action')
              ->addIndexColumn()
              ->make(true);
        }
        return view('videos.index');
    }

    public function show($category,$id)
    {

        $data=DB::table('videos AS v')
            ->select('v.*')
            ->where('category_name',$category)
            ->where('id',$id)
            ->get();

      return response()->json(['data'=>$data[0]]);
     
       
    }

    public function update(Request $request, $id)
    {
        
        $input=$request->input('data');
// print_r($input);

        try{
                $video=Videos::findOrFail($id);
                $video->video_link=$input['video_url'];
                $video->video_title=$input['video_title'];
                $video->video_description=$input['video_description'];
                $video->save();
                return response()->json($video, 201);
        }
        catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
            }

    }

}
