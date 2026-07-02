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
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('doctors', DoctorController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('users', UserController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('transactions', TransactionController::class);
        Route::resource('schedules', DoctorScheduleController::class);

        Route::get('bookings', [BookingController::class, 'adminIndex'])->name('bookings.index');
        Route::get('bookings/{id}', [BookingController::class, 'adminShow'])->name('bookings.show');

        Route::get('consultations', [ConsultationController::class, 'adminIndex'])->name('consultations.index');
        Route::get('consultations/{id}', [ConsultationController::class, 'adminShow'])->name('consultations.show');

        // AJAX (khusus admin, karena hanya admin yang boleh edit/hapus data master)
        Route::post('ajax/services/getEditForm', [ServiceController::class, 'getEditForm'])->name('services.getEditForm');
        Route::post('ajax/services/saveDataUpdate', [ServiceController::class, 'saveDataUpdate'])->name('services.saveDataUpdate');
        Route::post('ajax/services/deleteData', [ServiceController::class, 'deleteData'])->name('services.deleteData');

        Route::post('ajax/services/getEditFormB', [ServiceController::class, 'getEditFormB'])->name('services.getEditFormB');


        Route::post('ajax/articles/getEditForm', [ArticleController::class, 'getEditForm'])->name('articles.getEditForm');
        Route::post('ajax/articles/saveDataUpdate', [ArticleController::class, 'saveDataUpdate'])->name('articles.saveDataUpdate');
        Route::post('ajax/articles/deleteData', [ArticleController::class, 'deleteData'])->name('articles.deleteData');

        Route::post('ajax/doctors/getEditForm', [DoctorController::class, 'getEditForm'])->name('doctors.getEditForm');
        Route::post('ajax/doctors/saveDataUpdate', [DoctorController::class, 'saveDataUpdate'])->name('doctors.saveDataUpdate');
        Route::post('ajax/doctors/deleteData', [DoctorController::class, 'deleteData'])->name('doctors.deleteData');

        Route::post('ajax/schedules/getEditForm', [DoctorScheduleController::class, 'getEditForm'])->name('schedules.getEditForm');
        Route::post('ajax/schedules/saveDataUpdate', [DoctorScheduleController::class, 'saveDataUpdate'])->name('schedules.saveDataUpdate');
        Route::post('ajax/schedules/deleteData', [DoctorScheduleController::class, 'deleteData'])->name('schedules.deleteData');

        Route::post('ajax/categories/getEditForm', [CategoryController::class, 'getEditForm'])->name('categories.getEditForm');
        Route::post('ajax/categories/saveDataUpdate', [CategoryController::class, 'saveDataUpdate'])->name('categories.saveDataUpdate');
        Route::post('ajax/categories/deleteData', [CategoryController::class, 'deleteData'])->name('categories.deleteData');

        Route::post('ajax/transactions/getEditForm', [TransactionController::class, 'getEditForm'])->name('transactions.getEditForm');
        Route::post('ajax/transactions/saveDataUpdate', [TransactionController::class, 'saveDataUpdate'])->name('transactions.saveDataUpdate');
        Route::post('ajax/transactions/deleteData', [TransactionController::class, 'deleteData'])->name('transactions.deleteData');

        Route::post('ajax/users/getEditForm', [UserController::class, 'getEditForm'])->name('users.getEditForm');
        Route::post('ajax/users/saveDataUpdate', [UserController::class, 'saveDataUpdate'])->name('users.saveDataUpdate');
        Route::post('ajax/users/deleteData', [UserController::class, 'deleteData'])->name('users.deleteData');
    });

Route::middleware(['auth', 'can:access-doctor'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {
        Route::get('profile', [DoctorProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [DoctorProfileController::class, 'update'])->name('profile.update');

        Route::get('bookings', [BookingController::class, 'doctorIndex'])->name('bookings.index');

        Route::get('consultations', [ConsultationController::class, 'doctorIndex'])->name('consultations.index');
        Route::get('consultations/{id}', [ConsultationController::class, 'doctorShow'])->name('consultations.show');
        Route::post('consultations/{id}/message', [ChatController::class, 'doctorChat'])->name('consultations.doctorChat');
        Route::post('consultations/{id}/close', [ChatController::class, 'close'])->name('consultations.close');

        Route::get('history', [ConsultationController::class, 'doctorHistory'])->name('history.index');
    });

Route::middleware(['auth', 'can:access-member'])
    ->prefix('member')
    ->name('member.')
    ->group(function () {
        Route::get('articles', [ArticleController::class, 'publicIndex'])->name('articles.index');
        Route::get('articles/{id}', [ArticleController::class, 'publicShow'])->name('articles.show');

        Route::get('doctors', [DoctorController::class, 'publicIndex'])->name('doctors.index');
        Route::get('doctors/{id}', [DoctorController::class, 'publicShow'])->name('doctors.show');

        Route::get('bookings', [BookingController::class, 'memberIndex'])->name('bookings.index');
        Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');

        Route::get('consultations', [ConsultationController::class, 'memberIndex'])->name('consultations.index');
        Route::get('consultations/{id}', [ConsultationController::class, 'memberShow'])->name('consultations.show');
        Route::post('consultations/{id}/message', [ChatController::class, 'memberChat'])->name('consultations.memberChat');

        Route::get('history', [ConsultationController::class, 'memberHistory'])->name('history.index');
    });
