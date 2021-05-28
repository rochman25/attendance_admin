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

Route::get('/test',[AuthController::class, 'index'])->name('api.test');
Route::post('/login', [AuthController::class, 'authenticate'])->name('api.auth.login');
Route::post('/refresh_token',[AuthController::class,'refreshToken'])->name('api.auth.refresh_token');

Route::middleware(['jwt.verify'])->group(function () {
    //user profile
    Route::get('/users/{id}',[UserController::class,'getProfile'])->name('api.user.profile');
    Route::post('/users/change_password/{id}',[UserController::class,'changePassword'])->name('api.user.change_password');
    
    //attendance employee
    Route::post('/attendances', [AttendanceEmployeeController::class, 'store'])->name('api.attendance.employee');
    Route::get('/attendances/{id}',[AttendanceEmployeeController::class,'getDetailAttendance'])->name('api.attendance.employee.detail');
    Route::get('/attendances/report/{id}',[AttendanceEmployeeController::class,'getEmployeeReportAttendance'])->name('api.attendance_history.employee');
});

