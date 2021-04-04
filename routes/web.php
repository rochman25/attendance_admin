<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('home.view');
});
