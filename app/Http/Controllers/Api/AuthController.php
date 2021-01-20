<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $email = $request->email;
        $opt=mt_rand(100000,999999);
        $mailData = [
            'title' => 'Registraion Email',
            'otp'=>$opt
        ];
  
        Mail::to($email)
              ->send(new EmailVerify($mailData));



        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }


             
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password) ;
        $user->api_token=Str::random(80);
        $user->otp=$opt;
        $user->token=Str::random(100);

        try{
            $user->save();
        }
        catch(\illuminate\Database\QueryException $e){
         dd($e->getMessage());
        }
        
       // print_r($request->input());die;

        if(!is_null($user)) {
            return response()->json(["data" =>  $user, 
                                     "success" => true,
                                     "message" => "Registration Success"
                                    ]);
        }

        else {
            return response()->json(["status" => "failed", 
                                   "success" => false, 
                                   "message" => "failed to register"]);
        }
        


    }
    

    public function Login(Request $request){


        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user=Auth::user();
            if($user['verify_email']==0){
                $response = ["message" =>'User Did Not Verify'];
                return response($response, 422);
            }

            $user->api_token=Str::random(80);
            $user->save();
            return response()->json(["user" => Auth::user(), 
            "message" => "login success"]);
        }
        else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    

    }

    public function changePassword(Request $request)
    {


      
            
        $user=User::where('email',$request->email);
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:6|same:confirm_password',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        
        $credentials['email'] = $request->email;
        $credentials['password']=$request->old_password;

      
        if (Auth::attempt($credentials)) {
            
            User::where('email',$request->email)
                       ->update(['password'=>bcrypt($request->new_password)]);

            return response()->json(["user" =>Auth::user(), 
                       "message" => "password changed"]);      
        }
        else {
            $response = ["message" =>'Incorrect Password'];
            return response($response, 422);
        }
        
    }


        public function logout()
        {


            $user_id = Auth::guard('api')->id();
            $user=User::findorFail($user_id);
            $user->api_token=null;
            $user->save();
            return response()->json(['data' => 'User logged out.'], 200);
            
        }


       


       

        public function resetPassword(Request $request)
        {
    
          
                
            $user=User::where('email',$request->email)->first();
            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:6|same:confirm_password',
            ]);
            if ($validator->fails())
            {
                return response(['errors'=>$validator->errors()->all()], 422);
            }
                      
          
                
            $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
            $from = Carbon::createFromFormat('Y-m-d H:s:i', $user['otp_expiry']);

            if($from->diffInHours($to)< env('OTP_EXPIRY')){

                if($user['otp'] !=$request->otp){
                   return response()->json(["message"=>"otp incorrect"]);
                }
                else{
                
                      User::where('email',$request->email)
                           ->update(['password'=>bcrypt($request->password)]);
    
                      return response()->json(["user" =>Auth::user(), 
                           "message" => "password changed"]);    
                   }  
            }
            else {
                $response = ["message" =>'Otp expired'];
                return response($response, 422);
            }
            
        }



}
