<?php

use App\Http\Controllers\AdministratorDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ServiceController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::delete('/logout', [HomeController::class, 'logout'])->middleware('auth');
Route::get('/patient', [PatientDashboardController::class, 'index'])->middleware('auth');
Route::get('/doctor', [DoctorDashboardController::class, 'index'])->middleware('auth');
Route::get('/login', [HomeController::class, 'login'])->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->middleware('guest');

// Administartor Route
Route::get('/administrator', [AdministratorDashboardController::class, 'index'])->middleware('auth');
Route::resource('/administrator/services', ServiceController::class)->middleware('auth');

