<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth.check')->group(function () {
    // 신규 대상자
    Route::controller(\App\Http\Controllers\Patient\PatientController::class)->prefix('patient')->group(function () {
        Route::get('upsert/{regist_num?}', 'upsert')->name('patient.upsert');
        Route::post('data', 'data')->name('patient.data');
    });

    // 전체 대상자 리스트
    Route::controller(\App\Http\Controllers\Register\RegisterController::class)->prefix('register')->group(function () {
        $reg_type_keys = array_keys(config('site.register.type'));

        Route::get('/', 'index')->name('register');
        Route::get('{type}-{tab}/{regist_num}', 'upsert')->where('type', implode('|', $reg_type_keys))->name('register.upsert');
        Route::post('data', 'data')->name('register.data');
    });

    // mypage
    Route::controller(\App\Http\Controllers\Mypage\MypageController::class)->prefix('mypage')->group(function () {
        Route::get('/', 'index')->name('mypage');
        Route::post('data', 'data')->name('mypage.data');
    });
});

// auth
Route::controller(\App\Http\Controllers\Auth\LoginController::class)->group(function () {
    Route::match(['get', 'post'], '/', 'login')->middleware('guest')->name('login');
    Route::post('logout', 'logout')->middleware('auth.check')->name('logout');
});

require __DIR__ . '/common.php';
