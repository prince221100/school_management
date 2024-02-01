<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassDataController;
use App\Http\Controllers\ExamDetailController;
use App\Http\Controllers\StudentAddController;
use App\Http\Controllers\StudentsInfoController;
use App\Http\Controllers\TeacherAddController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


// Login
Route::get('/', function () {
    return view('login');
});
Route::post('/login',[AdminController::class,'login'])->name('login');

// Logout :-

Route::get('/logout',[AdminController::class,'logout'])->name('logout');

// Register Page :

Route::get('/register',function(){
    return view('register');
});
Route::post('/insert',[AdminController::class,'register_data'])->name('register');

//dashboard Page:-

Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');


// forgot password :

Route::get('/forgot_password',[AdminController::class,'forgot_password'])->name('forgot_password');
Route::post('/forgot',[AdminController::class,'forgot'])->name('forgot');
Route::get('/reset_password/{email}/{token}',[AdminController::class,'reset_password'])->name('reset_password');
Route::get('/reset',[AdminController::class,'reset'])->name('reset');
Route::post('/reset',[AdminController::class,'reset'])->name('reset');

// Profile :
Route::get('/profile',[AdminController::class,'profile'])->name('profile');
Route::post('/update_profile',[AdminController::class,'update_profile'])->name('update_profile');

// Add Teacher resource
Route::resource('addteacher', TeacherAddController::class);

// Add Student resource
Route::resource('addstudent', StudentAddController::class);

//Assign Class to teacher
Route::get('/assignclass-teacher',[ClassDataController::class,'assignclass_teacher'])->name('assignclassteacher');
Route::post('/assignclass-teacher',[ClassDataController::class,'addclassteacher'])->name('addclasst');
Route::get('/showdata',[ClassDataController::class,'showdata'])->name('showdata');

// Edit Class
Route::get('/editclassteacher/{id}',[ClassDataController::class,'editdata'])->name('editclassteacher');
Route::post('/editclassteacher/{id}',[ClassDataController::class,'updatedata'])->name('updateclassteacher');

// Delete Class
Route::get('/delclassteacher/{id}',[ClassDataController::class,'deldata'])->name('delclassteacher');

// Assign Class to teacher
Route::get('/assignclass-student',[StudentsInfoController::class,'assignclass_student'])->name('assignclassstudent');
Route::post('/assignclass-student',[StudentsInfoController::class,'addclassstudent'])->name('addclasss');
Route::get('/showdata-student',[StudentsInfoController::class,'showdatastudent'])->name('showdatastudent');

// Edit class student
Route::get('/editclassstudent/{id}',[StudentsInfoController::class,'editdatastudent'])->name('editclassstudent');
Route::post('/editclassstudent/{id}',[StudentsInfoController::class,'updatedatastudent'])->name('updateclassstudent');

Route::get('/delclassstudent/{id}',[StudentsInfoController::class,'deldatastudent'])->name('delclassstudent');

// Classmate show
Route::get('/classmate',[StudentsInfoController::class,'classmatedetail'])->name('classmatedetails');

// Subject details
Route::get('/subjectdetails',[StudentsInfoController::class,'subjectdetails'])->name('subjectdetails');

// Exam details
Route::get('/exam-assign',[ExamDetailController::class,'exam_assign'])->name('exam_assign');
Route::post('/addexam',[ExamDetailController::class,'addexam'])->name('addexam');
Route::get('/show-examdetails',[ExamDetailController::class,'showexamdetails'])->name('showexamdetails');

Route::get('/editexamdetails/{id}',[ExamDetailController::class,'editexamdetails'])->name('editexamdetails');
Route::post('/updateexamdetails/{id}',[ExamDetailController::class,'updateexamdetails'])->name('updateexamdetails');

Route::get('/delexamdetails/{id}',[ExamDetailController::class,'delexamdetails'])->name('delexamdetails');

// student show data exam
Route::get('/showexamdata',[ExamDetailController::class,'showexamdata'])->name('showexamdata');
