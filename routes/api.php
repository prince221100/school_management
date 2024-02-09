<?php

use App\Http\Controllers\Api\StudentDataController;
use App\Http\Controllers\Api\TeacherDataController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user',function(){
//     echo "Hello World";
// });
// Route::post('/user',function(){
//     return response()->json('Post api hit successfully!!');
// });

Route::post('/register',[UserController::class,'register']);

Route::post('/signin',[UserController::class,'signin']);

Route::post('/forgot_password',[UserController::class,'forgot']);
Route::get('/reset_password',[UserController::class,'reset_password']);

Route::group(['middleware' => ['auth:api']], function(){

    Route::post('/userdetails',[UserController::class,'userdetails']);
    Route::post('/profile',[UserController::class,'profile']);
    Route::post('/logout',[UserController::class,'logout']);

    // Teacher Data Add ,Edit,Delete :-

    Route::post('/addteacher',[TeacherDataController::class,'addteacher']);
    Route::post('/edit_teacherdetails/{id}',[TeacherDataController::class,'edit_teacherdetails']);
    Route::post('/delete_teacherdetails/{id}',[TeacherDataController::class,'delete_teacherdetails']);

    Route::post('/showteacher',[TeacherDataController::class,'showteacher']);


    // Student Data Add ,Edit,Delete:-
    Route::post('/addstudent',[StudentDataController::class,'addstudent']);
    Route::post('/edit_studentdetails/{id}',[StudentDataController::class,'edit_studentdetails']);
    Route::post('/delete_studentdetails/{id}',[StudentDataController::class,'delete_studentdetails']);

    Route::post('/showstudent',[StudentDataController::class,'showstudent']);


});

