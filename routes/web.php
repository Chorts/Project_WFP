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
use App\Http\Controllers\ConsultationHistoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/myprofile', function () {
        return view('about-me');
    });
    Route::get('/chat', [ChatController::class, 'bacaChat'])->name('chat.baca');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


        Route::resource('users', UserController::class);
        Route::post('ajax/users/getEditForm', [UserController::class, 'getEditForm'])->name('users.getEditForm');
        Route::post('ajax/users/saveDataUpdate', [UserController::class, 'saveDataUpdate'])->name('users.saveDataUpdate');
        Route::post('ajax/users/deleteData', [UserController::class, 'deleteData'])->name('users.deleteData');

        Route::resource('schedules', DoctorScheduleController::class);
        Route::post('ajax/schedules/getEditForm', [DoctorScheduleController::class, 'getEditForm'])->name('schedules.getEditForm');
        Route::post('ajax/schedules/saveDataUpdate', [DoctorScheduleController::class, 'saveDataUpdate'])->name('schedules.saveDataUpdate');
        Route::post('ajax/schedules/deleteData', [DoctorScheduleController::class, 'deleteData'])->name('schedules.deleteData');

        Route::get('bookings', [BookingController::class, 'adminIndex'])->name('bookings.index');
        Route::post('bookings', [BookingController::class, 'adminStore'])->name('bookings.store');
        Route::get('bookings/{id}', [BookingController::class, 'adminShow'])->name('bookings.show');
        Route::post('ajax/bookings/getEditForm', [BookingController::class, 'getEditForm'])->name('bookings.getEditForm');
        Route::post('ajax/bookings/saveDataUpdate', [BookingController::class, 'saveDataUpdate'])->name('bookings.saveDataUpdate');
        Route::post('ajax/bookings/deleteData', [BookingController::class, 'deleteData'])->name('bookings.deleteData');

        Route::resource('articles', ArticleController::class);
        Route::get('articles', [ArticleController::class, 'adminIndex'])->name('articles.index');
        Route::get('articles/{id}', [ArticleController::class, 'adminShow'])->name('articles.show');
        Route::post('ajax/articles/getEditForm', [ArticleController::class, 'getEditForm'])->name('articles.getEditForm');
        Route::post('ajax/articles/saveDataUpdate', [ArticleController::class, 'saveDataUpdate'])->name('articles.saveDataUpdate');
        Route::post('ajax/articles/deleteData', [ArticleController::class, 'deleteData'])->name('articles.deleteData');
        Route::get('consultations', [ConsultationController::class, 'adminIndex'])->name('consultations.index');
        Route::get('consultations/{id}', [ConsultationController::class, 'adminShow'])->name('consultations.show');

        Route::resource('doctors', DoctorController::class);
        Route::post('ajax/doctors/getEditForm', [DoctorController::class, 'getEditForm'])->name('doctors.getEditForm');
        Route::post('ajax/doctors/saveDataUpdate', [DoctorController::class, 'saveDataUpdate'])->name('doctors.saveDataUpdate');
        Route::post('ajax/doctors/deleteData', [DoctorController::class, 'deleteData'])->name('doctors.deleteData');
    });

Route::middleware(['auth', 'can:access-doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {
        Route::get('profile', [DoctorProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [DoctorProfileController::class, 'update'])->name('profile.update');


        Route::get('consultations', [ConsultationController::class, 'doctorIndex'])->name('consultations.index');
        Route::get('consultations/{id}', [ConsultationController::class, 'doctorShow'])->name('consultations.show');
        Route::post('consultations/{id}/close', [ConsultationController::class, 'close'])->name('consultations.close');
        Route::post('consultations/{id}/message', [ChatController::class, 'doctorChat'])->name('consultations.doctorChat');

        Route::get('history', [ConsultationController::class, 'doctorHistory'])->name('history.index');

        Route::get('bookings', [BookingController::class, 'doctorIndex'])->name('bookings.index');
        Route::get('doctors', [DoctorController::class, 'doctorIndex'])->name('doctors.index');
        Route::get('articles', [ArticleController::class, 'doctorIndex'])->name('articles.index');
        Route::get('consultations', [ConsultationController::class, 'doctorIndex'])->name('consultations.index');
    });

Route::middleware(['auth', 'can:access-member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {
        Route::get('articles', [ArticleController::class, 'memberIndex'])->name('articles.index');
        Route::get('articles/{id}', [ArticleController::class, 'memberShow'])->name('articles.show');

        Route::get('doctors', [DoctorController::class, 'publicIndex'])->name('doctors.index');
        Route::get('doctors/{id}', [DoctorController::class, 'publicShow'])->name('doctors.show');

        Route::get('bookings', [BookingController::class, 'memberIndex'])->name('bookings.index');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [BookingController::class, 'memberStore'])->name('bookings.store');

        Route::get('consultations', [ConsultationController::class, 'memberIndex'])->name('consultations.index');
        Route::post('consultations/{id}', [ConsultationController::class, 'store'])->name('consultations.store');

        Route::get('consultations/{id}', [ConsultationController::class, 'memberShow'])->name('consultations.show');
        Route::post('consultations/{id}/message', [ChatController::class, 'memberChat'])->name('consultations.memberChat');

        Route::get('history', [ConsultationController::class, 'memberHistory'])->name('history.index');
    });
