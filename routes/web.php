<?php

use Illuminate\Support\Facades\Route;

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




    Route::get('/',[\App\Http\Controllers\FrontController::class,  'home'])->name('home');

    Route::get('get-subjects/{id}', [\App\Http\Controllers\FrontController::class,  'getSubjects'])->name('get-subjects');
    Route::get('get-exams/{id}', [\App\Http\Controllers\FrontController::class,  'getExams'])->name('get-exams');
    Route::get('get-rooms/{id}', [\App\Http\Controllers\FrontController::class,  'getRooms'])->name('get-get-rooms');
    Route::get('get-rooms/{id}', [\App\Http\Controllers\FrontController::class,  'getRooms'])->name('get-get-rooms');



    Route::post('exam-front', [\App\Http\Controllers\FrontController::class,  'getExam'])->name('exam.front');

    Route::post('userLogin', [\App\Http\Controllers\FrontController::class,  'login'])->name('userLogin');
    Route::get('userLogout', [\App\Http\Controllers\FrontController::class,  'logout'])->name('userLogout');



//userLogin
