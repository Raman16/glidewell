<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index(Request $request) {


        if ($request->ajax()) {
              return DataTables()->of(User::select('*')->agents()->withTrashed())
              ->addColumn('action', 'agent.action')
              ->addIndexColumn()
              ->make(true);
        }
        return view('agent.index');
    }

  public function store(Request $request){

        $data=$request->input()['data'];
        $user = new User;
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=bcrypt($data['password']);
        $user->phone_number=$data['phone'];

        $user->is_admin=3;
        $user->api_token=Str::random(80);
        $user->status=1;

        try{
            $user->save();
            return response()->json($user, 201);
        }
        catch(\illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }
        

      
  }
    public function destroy(Request $request)
    {
        
        $user=User::findOrFail($request->input('data')['id']);
        try{
            $user->delete();
            return response()->json()(['message'=>'Deleted Successfully',201]);
        }
        catch(\illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }

       
    }

    public function changeStatus(Request $request){

        if($request->input('data')['status']=='Inactive'){
            $user=User::where('id',$request->input('data')['id'])->withTrashed()->first();
            $user->restore();
            return response()->json(['message'=>'status changed Active',201]);
        }else{
            $user=User::findorFail($request->input('data')['id']);
            $user->delete();
            return response()->json(['message'=>'status changed Inactive',201]);
        }
    }




}
