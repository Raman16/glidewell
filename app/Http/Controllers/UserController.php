<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {


        if ($request->ajax()) {
              return DataTables()->of(User::select('*')->users()->withTrashed())
              ->addColumn('action', 'users.action')
              ->addColumn('status', 'users.status')
              ->rawColumns(['action','status'])
              ->addIndexColumn()
              ->make(true);
        }
        return view('users.index');
    }

    public function show($id)
    {
        return ['data'=>User::findorFail($id)];
    }
    public function update(Request $request, $id)
    {
        
        $input=$request->input('data');

        $user=User::findOrFail($id);
        $user->name=$input['name'];
        $user->email=$input['email'];
        $user->phone_number=$input['phone'];
        $user->status=$input['status'];
        $user->save();
        return response()->json($user, 201);

    }
    public function destroy(Request $request)
    {
        
        $user=User::findOrFail($request->input('data')['id']);
//dd($user);
        $user->delete();
        return response()->json()(['message'=>'Deleted Successfully',201]);
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
