<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceStudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login.view');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login.action');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');

    Route::get('/',[HomeController::class,'index'])->name('home.view');

    Route::get('/home',function(){
        return view('pages.dashboard');
    });

    //route resource
    //users
    Route::resource('users', UserController::class);
    //roles
    Route::resource('roles', RoleController::class);
    //students
    Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');
    Route::resource('students', StudentController::class);
    //teachers
    Route::get('teachers/list', [TeacherController::class, 'getTeachers'])->name('teachers.list');
    Route::resource('teachers', TeacherController::class);
    //attendances
    Route::get('attendances/list', [AttendanceController::class, 'getAttendances'])->name('attendances.list');
    Route::resource('attendances', AttendanceController::class);
    //attendance students
    Route::get('attendace_students/list',[AttendanceStudentController::class,'getStudentAttendances'])->name('attendance_students.list');
    Route::get('attendance_students',[AttendanceStudentController::class,'index'])->name('attendance_students.index');
    Route::delete('attendance_students/{id}',[AttendanceStudentController::class,'destroy'])->name('attendance_students.destroy');
    Route::get('attendance_students/export/', [AttendanceStudentController::class,'export'])->name('attendance_students.export');

});
