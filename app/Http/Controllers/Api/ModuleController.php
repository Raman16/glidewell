<?php

namespace App\Http\Controllers\Api;

use App\FlashCards;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return response()->json(Modules::all(),201);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mod=new Modules;
        $this->authorize('create',$mod);

        $mod->name=$request->input('name');
        $mod->save();
        return response()->json($mod, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAll(){
        return response()->json(Modules::with('flashCards')->get());

    }
    public function showModules(){
        return response()->json(Modules::all());

    }
    public function showModulesQuestions($id){

        $module_id=Modules::select('id','name')->where('id',$id)
                           ->orWhere('api_name',$id)->get();
        // $card=FlashCards::select('id','description','question','reference','module_id')
        //     ->where('module_id',$module_id[0]['id'])->get();
        // $card[0]['module_name']=$module_id[0]['name'];
        
       
         $card=Modules::with('flashcards')
            ->where('id',$module_id[0]['id'])->get();
          // echo  '<pre>';print_r($card);die;
        
        return response()->json($card, 201);

    }
    public function show($id)
    {
        if($id=='all'){
            return response()->json(Modules::with('flashCards')->findorFail($id));
        }
        return Modules::with('flashCards')->findorFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $mod=Modules::findOrFail($id);
        $this->authorize('update',$mod);

        $mod->name=$request->input('name');
        $mod->save();
        return response()->json($mod, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mod=Modules::findOrFail($id);
        $this->authorize('delete',$mod);

        $mod->delete();
        return response()->json(["message"=>"Deleted"]);
    }
}
