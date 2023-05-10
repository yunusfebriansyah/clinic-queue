<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AdministratorDashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\DoctorTreatmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\PatientTreatmentController;
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
Route::get('/register', [HomeController::class, 'register'])->middleware('guest');
Route::post('/register', [HomeController::class, 'actionRegister'])->middleware('guest');

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
Route::get('/administrator/treatments/print', [TreatmentController::class, 'print'])->middleware('is_administrator');
Route::resource('/administrator/treatments', TreatmentController::class)->except(['destroy', 'create', 'store'])->middleware('is_administrator');
Route::get('/administrator/queues', [AdministratorDashboardController::class, 'queue'])->middleware('is_administrator');
Route::get('/administrator/load-queues', [AdministratorDashboardController::class, 'loadQueue'])->middleware('is_administrator');


// Patient Routes
Route::get('/patient', [PatientDashboardController::class, 'index'])->middleware('is_patient');
Route::get('/patient/edit-profile', [PatientDashboardController::class, 'editProfile'])->middleware('is_patient');
Route::put('/patient/edit-profile', [PatientDashboardController::class, 'updateProfile'])->middleware('is_patient');
Route::get('/patient/change-password', [PatientDashboardController::class, 'editPassword'])->middleware('is_patient');
Route::put('/patient/change-password', [PatientDashboardController::class, 'updatePassword'])->middleware('is_patient');
Route::get('/patient/registers', [PatientTreatmentController::class, 'create'])->middleware('is_patient');
Route::post('/patient/registers', [PatientTreatmentController::class, 'store'])->middleware('is_patient');
Route::resource('/patient/treatments', PatientTreatmentController::class)->except(['create', 'store', 'destroy', 'show'])->middleware('is_patient');
Route::get('/patient/queue/{treatment}', [PatientDashboardController::class, 'queue'])->middleware('is_patient');
Route::get('/patient/load-queue/{treatment}', [PatientDashboardController::class, 'loadQueue'])->middleware('is_patient');

// Doctor Routes
Route::get('/doctor', [DoctorDashboardController::class, 'index'])->middleware('is_doctor');
Route::get('/doctor/edit-profile', [DoctorDashboardController::class, 'editProfile'])->middleware('is_doctor');
Route::put('/doctor/edit-profile', [DoctorDashboardController::class, 'updateProfile'])->middleware('is_doctor');
Route::get('/doctor/change-password', [DoctorDashboardController::class, 'editPassword'])->middleware('is_doctor');
Route::put('/doctor/change-password', [DoctorDashboardController::class, 'updatePassword'])->middleware('id_doctor');
Route::resource('/doctor/treatments', DoctorTreatmentController::class)->except(['create', 'store', 'destroy'])->middleware('is_doctor');
Route::get('/doctor/queues', [DoctorDashboardController::class, 'queues'])->middleware('is_doctor');
