<?php

use App\Http\Controllers\HomeController;
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
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/admin-access', function()
{
  var_dump(auth()->user());
});

Route::get('/admin-access/login', [HomeController::class, 'loginWorker'])->middleware('guest');
Route::post('/admin-access/login', [HomeController::class, 'actionLoginWorker'])->middleware('guest');

Route::get('/admin-access/index', function(){
  return 'oke';
})->middleware('auth');
