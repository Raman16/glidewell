<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::post('/save-token', [App\Http\Controllers\HomeController::class, 'saveToken'])->name('save-token');
Route::post('/send-notification', [App\Http\Controllers\HomeController::class, 'sendNotification'])->name('send.notification');

Route::group(['middleware' => ['auth']], function(){

Route::prefix('admin')->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    });
    Route::get('admin-list', 'AdminController@index');
    Route::post('add-admin', 'AdminController@store');
    Route::delete('delete-admin', 'AdminController@destroy');

    Route::get('agent-list', 'AgentController@index');
    Route::post('add-agent', 'AgentController@store');
    Route::delete('delete-agent', 'AgentController@destroy');
    Route::post('disable-agent', 'AgentController@changeStatus');

    
    Route::prefix('users')
          ->group(function () {
            Route::get('users-list', 'UserController@index');
            Route::get('edit-user/{id}', 'UserController@show');
            Route::put('update-user/{id}', 'UserController@update');
            Route::delete('delete-user', 'UserController@destroy');
            Route::post('change-user-status', 'UserController@changeStatus');



     });



     Route::prefix('question-management')
     ->namespace('QuestionManagement')
     ->group(function () {
       
              Route::get('questions-category-list', 'QuestionsCategoryController@index');


              Route::get('questions-list/{category_list}', 'QuestionsMgtController@index');

              Route::post('add-question/{category}', 'QuestionsMgtController@store');
              Route::put('update-question/{category}', 'QuestionsMgtController@update');

              Route::get('edit-question/{category}/{id}', 'QuestionsMgtController@show');
              Route::post('enable-disable-question/{category}', 'QuestionsMgtController@enableDisable');

              Route::get('questions-form/{category}', function ($category) {
                return view('questions.question_form',['category'=>$category]);
            });
            
    //    Route::get('edit-user/{id}', 'UserController@show');
    //    Route::put('update-user/{id}', 'UserController@update');
    //    Route::delete('delete-user', 'UserController@destroy');
    });

    Route::prefix('videos-management')
    ->namespace('Videos')
    ->group(function () {
             Route::get('video-list', 'VideosController@index');
             Route::put('update-video/{category}', 'VideosController@update');
             Route::get('edit-video/{category}/{id}', 'VideosController@show');

   });

    Route::prefix('flashcards')
           ->namespace('Flashcards')
           ->group(function () {

                   //Modules Route
                   Route::get('modules-list', 'ModuleController@index');
                   Route::put('update-module/{id}', 'ModuleController@update');
                   Route::get('edit-module/{id}', 'ModuleController@show');
                   Route::delete('delete-module', 'ModuleController@destroy');
                   Route::post('add-module', 'ModuleController@store');
                   Route::post('enable-disable-module', 'ModuleController@enableDisable');

                   //Flashcard Questions Route
                   Route::get('flashcard-questions-list', 'FlashcardQuestionController@index');
                   Route::get('flashcard-questions-list/{module_id}', 'FlashcardQuestionController@getModuleFcs');

                   Route::post('flashcard-add-question', 'FlashcardQuestionController@store');
                   Route::get('flashcard-edit-question/{id}', 'FlashcardQuestionController@show');
                   Route::put('flashcard-update-question/{id}', 'FlashcardQuestionController@update');
                   Route::delete('flashcard-delete-question', 'FlashcardQuestionController@destroy');
                   Route::get('get-modules','FlashcardQuestionController@getModules');
                   Route::post('enable-disable-flashcard', 'FlashcardQuestionController@enableDisable');

             });
      });

    

Route::get('/home', 'HomeController@index')->name('home');

});
