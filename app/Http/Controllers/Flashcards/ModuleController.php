<?php

namespace App\Http\Controllers\Flashcards;

use App\FlashCards;
use App\Http\Controllers\Controller;
use App\Modules;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ModuleController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
              return DataTables()->of(Modules::select('*')->withTrashed())
              ->addColumn('action', 'flashcards.modules.action')
              ->rawColumns(['action'])
                                ->addIndexColumn()
                                ->make(true);
        }
        return view('flashcards.modules.index');
    }

    public function store(Request $request)
    {
        $mod_name=$request->input('data')['name'];
        $mod=new Modules;
        $mod->name=$mod_name;
        $mod->api_name=str_replace(' ','',$mod_name);
        $mod->save();
        return response()->json($mod, 201);

    }

    public function show($id)
    {
        return ['data'=>Modules::findorFail($id)];
    }

    public function update(Request $request, $id)
    {
        
        $input=$request->input('data');
        $mod=Modules::findOrFail($id);
        $mod->name=$input['name'];
        $mod->save();
        return response()->json($mod, 201);

    }

    public function enableDisable(Request $request){

        $id=$request->input('data')['id'];
        if($request->input('data')['status']=='disable'){

            $mod=Modules::where('id',$id)->withTrashed()->first();
            $mod->restore();

            // $fc=FlashCards::where('module_id',$id)->withTrashed()->first();
            // $fc->restore();

            return response()->json(['message'=>'status changed Active',201]);
        }else{

            $mod=Modules::findorFail($id);
            $mod->delete();

            // $fc=FlashCards::where('module_id',$id);
            // $fc->delete();
            return response()->json(['message'=>'status changed Inactive',201]);
        }
       


    }

    public function destroy(Request $request)
    {
        
        $module=Modules::findOrFail($request->input('data')['id']);
        $module->delete();
        return response()->json()(['message'=>'Deleted Successfully',201]);
    }
}
