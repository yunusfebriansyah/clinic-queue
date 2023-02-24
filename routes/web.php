<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdministratorDashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TreatmentController;
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
Route::get('/login', [HomeController::class, 'login'])->middleware('guest');
Route::post('/login', [HomeController::class, 'actionLogin'])->middleware('guest');

// Administartor Routes
Route::get('/administrator', [AdministratorDashboardController::class, 'index'])->middleware('is_administrator');
Route::post('/administrator', [AdministratorDashboardController::class, 'changeQueue'])->middleware('is_administrator');
Route::get('/administrator/edit-profile', [AdministratorDashboardController::class, 'editProfile'])->middleware('is_administrator');
Route::put('/administrator/edit-profile', [AdministratorDashboardController::class, 'updateProfile'])->middleware('is_administrator');
Route::get('/administrator/change-password', [AdministratorDashboardController::class, 'editPassword'])->middleware('is_administrator');
Route::put('/administrator/change-password', [AdministratorDashboardController::class, 'updatePassword'])->middleware('is_administrator');
Route::resource('/administrator/services', ServiceController::class)->middleware('is_administrator');
Route::resource('/administrator/diseases', DiseaseController::class)->except(['create', 'show'])->middleware('is_administrator');
Route::resource('/administrator/users/doctors', DoctorController::class)->middleware('is_administrator');
Route::resource('/administrator/users/administrators', AdministratorController::class)->middleware('is_administrator');
Route::resource('/administrator/users/patients', PatientController::class)->middleware('is_administrator');
Route::resource('/administrator/events', EventController::class)->middleware('is_administrator');
Route::resource('/administrator/treatments', TreatmentController::class)->except(['destroy', 'create', 'store'])->middleware('is_administrator');
Route::get('/administrator/queues', [AdministratorDashboardController::class, 'queue'])->middleware('is_administrator');
Route::get('/administrator/load-queues', [AdministratorDashboardController::class, 'loadQueue'])->middleware('is_administrator');


// Patient Routes
Route::get('/patient', [PatientDashboardController::class, 'index'])->middleware('is_patient');

// Doctor Routes
Route::get('/doctor', [DoctorDashboardController::class, 'index'])->middleware('is_doctor');
