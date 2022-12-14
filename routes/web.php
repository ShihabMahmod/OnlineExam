<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student\studentController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\examController;

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

Route::get('/',[studentController::class,'index']);
Route::get('/load-login',[studentController::class,'lodaLogin']);
Route::get('/registration',[studentController::class,'registration']);
Route::post('/create-student',[studentController::class,'createStudent']);
Route::post('/login',[studentController::class,'studentLogin']);

Route::group(['middleware'=>['web','checkSttudent']],function(){
        Route::get('/log-out',[studentController::class,'logout']);
});




Route::group(['middleware'=>['web','checkAdmin']],function(){

        Route::get('/subject-load',[subjectController::class,'subjectLoad']);
        Route::get('/subject-list',[subjectController::class,'subjectList'])->name('subjectList');
        Route::post('/add-subject',[subjectController::class,'addSubject'])->name('addSubject');
        Route::get('/delete-subject/{id}',[subjectController::class,'deleteSubject']);
        

        Route::get('/exam-load',[examController::class,'examLoad'])->name('examLoad');
        Route::get('exam-list',[examController::class,'examList'])->name('examList');
        Route::post('/add-exam',[examController::class,'addExam'])->name('addExam');
        Route::post('/edit-exam/{id}',[examController::class,'editExam'])->name('editExam');
        Route::get('/delete-exam/{id}',[examController::class,'deleteExam']);
        

});
