<?php

namespace App\Http\Controllers\Flashcards;

use App\FlashCards;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules;
use Illuminate\Support\Facades\DB;

class FlashcardQuestionController extends Controller
{
    public function index(Request $request) {
       
        //$fcQs= FlashCards::with('module')->select('*');

         $fcqs=DB::table('flash_cards AS fc')
            ->leftJoin('modules AS m','m.id', '=', 'fc.module_id')
                ->select('fc.*','m.id as module_id','m.name')
                ->where('m.deleted_at','=',null)
            ->get();
          //  dd($fcqs);

        if ($request->ajax()) {
              return DataTables()->of($fcqs)
              ->addColumn('action', 'flashcards.flashcard_questions.action')
              ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

           
        }
        return view('flashcards.flashcard_questions.index');
    }



    public function getModuleFcs(Request $request,$module_id) {
       
        //$fcQs= FlashCards::with('module')->select('*');

         $fcqs=DB::table('flash_cards AS fc')
            ->leftJoin('modules AS m','m.id', '=', 'fc.module_id')
                ->select('fc.*','m.id as module_id','m.name')
                ->where('m.id',$module_id)
            ->get();
          //  dd($fcqs);

        if ($request->ajax()) {
              return DataTables()->of($fcqs)
              ->addColumn('action', 'flashcards.flashcard_questions.action')
              ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

           
        }
        return view('flashcards.flashcard_questions.index');
    }



    public function getModules(){
        return response()->json(Modules::all());
    }

    public function store(Request $request)
    {
      
     
           $data=$request->input()['data'];
          try {

                $fc=new FlashCards;
                $fc->module_id=$data['module_id'];
                $fc->question=$data['question'];
                $fc->description=$data['description'];
                $fc->reference=$data['reference'];
                $fc->save();
      } 
       catch (\Illuminate\Database\QueryException $exception) {
        
        $errorInfo = $exception->errorInfo;
        return response()->json($errorInfo, 201);
    }

    }

    public function show($id)
    {
        return ['data'=>FlashCards::findorFail($id)];
    }

    public function update(Request $request, $id)
    {
        
         $data=$request->input()['data'];
         
          try {

                $fc=FlashCards::findOrFail($id);
                
                $fc->module_id=$data['module_id'];
                $fc->question=$data['question'];
                $fc->description=$data['description'];
                $fc->reference=$data['reference'];
                $fc->save();
                return response()->json($fc, 201);

                //
      } 
       catch (\Illuminate\Database\QueryException $exception) {
        
        $errorInfo = $exception->errorInfo;
        return response()->json($errorInfo, 201);
      }

    }


    public function enableDisable(Request $request){

        if($request->input('data')['status']=='disable'){
            $fc=FlashCards::where('id',$request->input('data')['id'])->withTrashed()->first();
            $fc->restore();
            return response()->json(['message'=>'status changed Active',201]);
        }else{
            $fc=FlashCards::findorFail($request->input('data')['id']);
            $fc->delete();
            return response()->json(['message'=>'status changed Inactive',201]);
        }
       


    }



    public function destroy(Request $request)
    {
        
        $id=$request->input('data')['id'];
       
        try {

                $fc=FlashCards::findOrFail($id);
                $fc->delete();
                return response()->json()(['message'=>'Deleted Successfully',201]);
            } 
            catch (\Illuminate\Database\QueryException $exception) {
            
            $errorInfo = $exception->errorInfo;
            return response()->json($errorInfo, 201);
        }

    }
}
