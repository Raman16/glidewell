<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function(){

    // Route::apiResources(['flashcards/modules'=>Api\ModuleController::class,
    // 'flashcards'=>Api\FlashCardController::class]);
    Route::post('store_module','Api\ModuleController@store');
    Route::post('store_flashcards','Api\FlashCardController@store');

    Route::get('flashcards/all','Api\ModuleController@showAll');
    Route::get('flashcards/modules','Api\ModuleController@showModules');
    Route::get('flashcards/{input}','Api\ModuleController@showModulesQuestions');


    // Route::get('quizzes','Api\QuizController@showQuizzes');
    // Route::post('quizzes/quizattempted','Api\QuizController@quizattempted');

});


//Route::post('emailverify','Api\VerifyEmailOtpController@verifyemail');             
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::post('change-password', 'Api\AuthController@changePassword');
//Route::post('resend-otp', 'Api\VerifyEmailOtpController@resendOtp');
Route::post('reset-password', 'Api\AuthController@resetPassword');


Route::post('logout', 'Api\AuthController@logout');

Route::fallback(function(){
  return response()->json(['message'=>"API not found/Authorized"],404);
});