<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register'=>false]);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('houses', \App\Http\Controllers\HouseController::class);
    Route::resource('designers', \App\Http\Controllers\DesignerController::class);
    Route::resource('workers', \App\Http\Controllers\WorkerController::class);
    Route::resource('reservations', \App\Http\Controllers\ReservationController::class);
    Route::resource('rooms', \App\Http\Controllers\RoomController::class);
    Route::resource('expenses', \App\Http\Controllers\ExpenseController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
});

require __DIR__.'/auth.php';
