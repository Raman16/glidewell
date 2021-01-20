<?php

namespace App\Http\Controllers\Api;

use App\FlashCards;
use App\Http\Controllers\Controller;
use App\Modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class FlashCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Modules::with('flashCards')->findorFail($id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $card=new FlashCards;
        $this->authorize('update',$card);
        // if(Gate::denies('update',$card)){
        //     abort(403,"Sorry You could not edit");
        // }
        $card->question=$request->input('question');
        $card->description=$request->input('description');
        $card->reference=$request->input('reference');
        $card->module_id=$request->input('module_id');
        $card->save();
        return response()->json($card, 201);//need to pass module and flashcarrd
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $module_id=Modules::select('id','name')->where('id',$id)
                          ->orWhere('name',$id)->get();
      
                        
        $card=FlashCards::select('id','description','question','reference','module_id')
                        ->where('module_id',$module_id[0]['id'])->get();
        $card[0]['module_name']=$module_id[0]['name'];
        return response()->json($card, 201);
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

        $card=FlashCards::findOrFail($id);
        $this->authorize('update',$card);

        $card->question=$request->input('question');
        $card->reference=$request->input('reference');
        $card->description=$request->input('description');
        $card->save();
        return response()->json($card, 201);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fc=FlashCards::findOrFail($id);
        $this->authorize('delete',$fc);
        $fc->delete();
        return response()->json(["message"=>"Deleted"]);
    }
}
