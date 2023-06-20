<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\isGuest;

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

Route::get('/', function () {
    return view('home');
});



Route::group(['middleware' => 'isLogin'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Route::get('/dashboard', [DashboardController::class, 'countDoctor']);
    Route::resource('/patient', PatientController::class);
    Route::resource('/doctor', DoctorController::class);
});

Route::group(['middleware' => 'isGuest'], function() {
    Route::get('/session', [SessionController::class, 'index']);
    Route::post('/session/login', [SessionController::class, 'login']);
    Route::get('/session/register', [SessionController::class, 'register']);
    Route::post('/session/register', [SessionController::class, 'create']);
});
Route::get('/session/logout', [SessionController::class, 'logout']);

