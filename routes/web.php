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
use Illuminate\Support\Facades\Auth;

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



Route::middleware(["auth"])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/myprofile', function () {
        return view('about-me');
    });
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

Route::post('ajax/articles/getEditForm', [ArticleController::class, 'getEditForm'])->name('articles.getEditForm');
Route::post('/ajax/articles/saveDataUpdate', [ArticleController::class, 'saveDataUpdate'])->name('articles.saveDataUpdate');
Route::post('/ajax/articles/deleteData', [ArticleController::class, 'deleteData'])->name('articles.deleteData');

Route::post('ajax/bookings/getEditForm', [BookingController::class, 'getEditForm'])->name('bookings.getEditForm');
Route::post('/ajax/bookings/saveDataUpdate', [BookingController::class, 'saveDataUpdate'])->name('bookings.saveDataUpdate');
Route::post('/ajax/bookings/deleteData', [BookingController::class, 'deleteData'])->name('bookings.deleteData');

Route::post('ajax/doctors/getEditForm', [DoctorController::class, 'getEditForm'])->name('doctors.getEditForm');
Route::post('/ajax/doctors/saveDataUpdate', [DoctorController::class, 'saveDataUpdate'])->name('doctors.saveDataUpdate');
Route::post('/ajax/doctors/deleteData', [DoctorController::class, 'deleteData'])->name('doctors.deleteData');

Route::post('ajax/schedules/getEditForm', [DoctorScheduleController::class, 'getEditForm'])->name('schedules.getEditForm');
Route::post('/ajax/schedules/saveDataUpdate', [DoctorScheduleController::class, 'saveDataUpdate'])->name('schedules.saveDataUpdate');
Route::post('/ajax/schedules/deleteData', [DoctorScheduleController::class, 'deleteData'])->name('schedules.deleteData');

Route::post('ajax/categories/getEditForm', [CategoryController::class, 'getEditForm'])->name('categories.getEditForm');
Route::post('/ajax/categories/saveDataUpdate', [CategoryController::class, 'saveDataUpdate'])->name('categories.saveDataUpdate');
Route::post('/ajax/categories/deleteData', [CategoryController::class, 'deleteData'])->name('categories.deleteData');

Route::post('ajax/transactions/getEditForm', [TransactionController::class, 'getEditForm'])->name('transactions.getEditForm');
Route::post('/ajax/transactions/saveDataUpdate', [TransactionController::class, 'saveDataUpdate'])->name('transactions.saveDataUpdate');
Route::post('/ajax/transactions/deleteData', [TransactionController::class, 'deleteData'])->name('transactions.deleteData');

Route::post('ajax/chats/getEditForm', [ChatController::class, 'getEditForm'])->name('chats.getEditForm');
Route::post('/ajax/chats/saveDataUpdate', [ChatController::class, 'saveDataUpdate'])->name('chats.saveDataUpdate');
Route::post('/ajax/chats/deleteData', [ChatController::class, 'deleteData'])->name('chats.deleteData');

Route::post('ajax/users/getEditForm', [UserController::class, 'getEditForm'])->name('users.getEditForm');
Route::post('/ajax/users/saveDataUpdate', [UserController::class, 'saveDataUpdate'])->name('users.saveDataUpdate');
Route::post('/ajax/users/deleteData', [UserController::class, 'deleteData'])->name('users.deleteData');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
