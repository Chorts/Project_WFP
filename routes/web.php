<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/myprofile', function () {
    return view('about-me');
});


Route::middleware(["auth"])->group(function () {
    Route::resource('services', ServiceController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('schedules', DoctorScheduleController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('users', UserController::class);
    Route::resource('chats', ChatController::class);
});


// Route::resource('services', ServiceController::class);
// Route::resource('categories', CategoryController::class);
// Route::resource('doctors', DoctorController::class);
// Route::resource('articles', ArticleController::class);
// Route::resource('transactions', TransactionController::class);
// Route::resource('schedules', DoctorScheduleController::class);
// Route::resource('bookings', BookingController::class);
// Route::resource('users', UserController::class);
// Route::resource('chats', ChatController::class);


Route::post('/ajax/services/getEditForm', [ServiceController::class, 'getEditForm'])->name('services.getEditForm');
Route::post('/ajax/services/getEditFormB', [ServiceController::class, 'getEditFormB'])->name('services.getEditFormB');
Route::post('/ajax/services/saveDataUpdate', [ServiceController::class, 'saveDataUpdate'])->name('services.saveDataUpdate');
Route::post('/ajax/services/deleteData', [ServiceController::class, 'deleteData'])->name('services.deleteData');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
