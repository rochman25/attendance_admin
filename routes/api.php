<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AttendanceStudentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test',[AuthController::class, 'index'])->name('api.test');
Route::post('/login', [AuthController::class, 'authenticate'])->name('api.auth.login');
Route::post('/refresh_token',[AuthController::class,'refreshToken'])->name('api.auth.refresh_token');

Route::middleware(['jwt.verify'])->group(function () {
    //user profile
    Route::get('/users/{id}',[UserController::class,'getProfile'])->name('api.user.profile');
    Route::post('/users/change_password/{id}',[UserController::class,'changePassword'])->name('api.user.change_password');
    
    //attendance student
    Route::post('/attendances/save', [AttendanceStudentController::class, 'store'])->name('api.attendance.student');
    Route::post('/attendances/multiple_student/save', [AttendanceStudentController::class, 'storeBulk'])->name('api.attendance.student.bulk');
    Route::get('/attendances/{id}',[AttendanceStudentController::class,'getDetailAttendance'])->name('api.attendance.student.detail');
    Route::get('/attendances/report/{id}',[AttendanceStudentController::class,'getStudentReportAttendance'])->name('api.attendance_history.student');

    //attendances
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('api.attendance.index');
    Route::get('/attendances/{id}/students', [AttendanceController::class ,'indexStudentsById'])->name('api.attendance.index.student');
});

