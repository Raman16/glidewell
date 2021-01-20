<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request) {


        if ($request->ajax()) {
              return DataTables()->of(User::select('*')->admins()->withTrashed())
              ->addColumn('action', 'admin.action')
              ->addIndexColumn()
              ->make(true);
        }
        return view('admin.index');
    }

  public function store(Request $request){

        $data=$request->input()['data'];
        $user = new User;
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=bcrypt($data['password']);
        $user->phone_number=$data['phone'];
        $user->is_admin=2;
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

}
