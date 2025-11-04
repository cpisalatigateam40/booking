<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;

// 🔐 AUTH
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/', '/booking');
Route::prefix('booking')
    ->name('booking.')
    ->controller(BookingController::class)
    ->group(function () {
        Route::get('/', 'create')->name('create');
        Route::get('/index', 'index')->name('index');
    });

Route::prefix('rooms')
    ->name('rooms.')
    ->controller(RoomController::class)
    ->group(function () {
        Route::get('/', 'schedule')->name('schedule');
        Route::get('/availability', 'checkAvailability')->name('availability');
    });

Route::middleware('auth')->group(function () {
    Route::prefix('booking')
        ->name('booking.')
        ->controller(BookingController::class)
        ->group(function () {
            Route::get('/manage-booking', 'manageBooking')->name('manage');
            Route::post('/store', 'storeBooking')->name('store');
            Route::delete('/{uuid}/delete', 'destroy')->name('destroy');
            Route::put('/{uuid}/approve', 'approve')->name('approve');
            Route::put('/{uuid}/reject', 'reject')->name('reject');
        });

    Route::prefix('rooms')
        ->name('rooms.')
        ->controller(RoomController::class)
        ->group(function () {
            Route::get('/manage-room', 'manageRoom')->name('manage');
            Route::post('/store', 'store')->name('store');
            Route::delete('/{uuid}/delete', 'destroy')->name('destroy');
        });

    Route::prefix('departments')
        ->name('departments.')
        ->controller(DepartmentController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
        });
});
