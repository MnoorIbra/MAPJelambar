<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EdcMachineController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\MapController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
  Route::resource('edc-machines', EdcMachineController::class);
  Route::get('/maps', [MapController::class, 'index'])->name('maps');
});

Route::get('/', function () {
    return redirect('/login');
})->name('root');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', function () {
    return redirect('/edc-machines');
})->name('home');