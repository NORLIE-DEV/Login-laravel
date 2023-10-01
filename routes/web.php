<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;




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

// Route::get('/', function () {
//     return 'home';
// });

// Route::get();
// Route::post();
// Route::put();
// Route::patch();
// Route::delete();
// Route::options();

// Route::get('/request-json',function(){
//     return response()->json(['nane'=>'norlie']);
// });

// Route::get('/',function(){
//     return view('welcome');
// });


//Route::get('/users', [UserController::class, 'index']);
// Route::get('users/{id}', [UserController::class, 'show']);
// Route::get('students/{id}', [StudentController::class, 'show']);

//common naming
//index - Show all data or students
//show - Show  a single data or student
//create - Show a form to  a new user
//store - Store a data
//edit - Show a form to edit a data
//update - update data
//destroy - delete a data



Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login/process', 'process');
    Route::get('/register',  'register');
    Route::post('store',  'store');
    Route::post('/logout', 'logout');

});


Route::controller(StudentController::class)->group(function(){
    Route::get('/','index')->middleware('auth');
    Route::get('/add/student','create')->middleware('auth');
    Route::post('/add/student','store');
    Route::get('/student/{id}','show');
    Route::put('/student/{student}','update');
    Route::delete('/student/{student}','destroy');
});

// Route::controller(StudentController::class)-group(function(){
//     Route::get('/','index')->middleware('auth');
//     Route::get('/add/student','create')->middleware('auth');
//     Route::post('/add/student',[StudentController::class,'store']);
//     Route::get('/student/{id}',[StudentController::class,'show']);
//     Route::put('/student/{student}',[StudentController::class,'update']);
//     Route::delete('/student/{student}',[StudentController::class,'destroy']);
// });



