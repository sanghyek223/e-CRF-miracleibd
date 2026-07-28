<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth.check')->group(function () {
    Route::controller(\App\Http\Controllers\Main\MainController::class)->group(function () {
        Route::get('/', 'main')->name('main');
        Route::post('data', 'data')->name('main.data');
    });

    // 신규 대상자
    Route::controller(\App\Http\Controllers\Patient\PatientController::class)->prefix('patient')->group(function () {
        Route::get('upsert', 'upsert')->name('patient.upsert');
        Route::post('data', 'data')->name('patient.data');
    });

    // mypage
    Route::controller(\App\Http\Controllers\Mypage\MypageController::class)->prefix('mypage')->group(function () {
        Route::get('/', 'index')->name('mypage');
        Route::post('data', 'data')->name('mypage.data');
    });
});

// auth
Route::controller(\App\Http\Controllers\Auth\LoginController::class)->prefix('auth')->group(function () {
    Route::match(['get', 'post'], 'login', 'login')->middleware('guest')->name('login');
    Route::post('logout', 'logout')->middleware('auth.check')->name('logout');
});

require __DIR__ . '/common.php';
