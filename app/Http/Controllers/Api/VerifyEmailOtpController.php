<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{

   public function verifyemail(Request $request){

  
    $user=User::where('email',$request->email)->first();

    $to = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());
    $from = Carbon::createFromFormat('Y-m-d H:s:i', $user['otp_expiry']);

    if($from->diffInHours($to)< env('OTP_EXPIRY')){

        if($user['otp'] !=$request->otp){
          return response()->json(["message"=>"otp incorrect"]);
        }else{

              $message=User::where('email',$request->email)
                            ->Where('otp',$request->otp)
                            ->update([
                                      'verify_email'=>1
                                    ]);
              if($message){
                    return response()->json(["message"=>"Success"]);
              }
        }
    }
    else{
      return response()->json(["message"=>"otp expired"]);
    }
  }


  public function resendOtp(Request $request){


    $email = $request->email;
    $otp=mt_rand(100000,999999);

    if($request->type=='email_verify'){

        $mailData = [
            'title' => 'Email Verification',
            'otp'=>$otp
        ];

        Mail::to($email)
            ->send(new EmailVerify($mailData));


        User::where('email',$request->email)
                ->Where('email',$email)
                ->update([
                    'otp'=>$otp,
                    'otp_expired'=>Carbon::now()
                    ]);

        return response()->json(["message" => "otp sent successfully"]);  
    }
    
    else{

       //password reset type=reset-pwd
        $mailData = [
            'title' => 'Reset Password',
            'otp'=>$otp
        ];

        Mail::to($email)
            ->send(new EmailVerify($mailData));


        User::where('email',$request->email)
                ->Where('email',$email)
                ->update([
                        'otp'=>$otp,
                        'otp_expired'=>Carbon::now()
                        ]);

        return response()->json(["message" => "reset otp sent successfully"]);  


    }

   
}


}
