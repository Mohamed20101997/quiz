<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['auth:web']], function () {

    Route::get('/','WelcomeController@index')->name('welcome');
    Route::resource('user','UserController');
    Route::resource('subject','SubjectController');

    Route::resource('exam','ExamController');
    Route::resource('question','QuestionController');

    //logout route
    Route::post('logout', 'AuthController@logout')->name('logout');


});  /** End of Route Group  */



/** Start Auth Section */

Route::group(['middleware'=>'guest:web','prefix'=>'admin'], function () {

    Route::get('login', 'AuthController@getLogin')->name('getLogin');
    Route::post('login', 'AuthController@login')->name('login');

});
