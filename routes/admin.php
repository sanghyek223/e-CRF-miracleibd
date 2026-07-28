<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Admin\Main\MainController::class)->group(function () {
//    Route::get('/', 'main')->name('main');
//    Route::post('data', 'data')->name('main.data');
});

// 회원관리
Route::controller(\App\Http\Controllers\Admin\Log\LogController::class)->prefix('log')->group(function () {
    Route::get('/', 'index')->name('log');
    Route::get('upsert/{sid}', 'upsert')->name('log.upsert');
    Route::post('data', 'data')->name('log.data');
});

// 회원관리
Route::controller(\App\Http\Controllers\Admin\Member\MemberController::class)->prefix('member')->group(function () {
    Route::get('/', 'index')->name('member');
    Route::get('upsert/{sid}', 'upsert')->name('member.upsert');
    Route::post('data', 'data')->name('member.data');
});

// auth
Route::controller(\App\Http\Controllers\Admin\Auth\LoginController::class)->prefix('auth')->group(function () {
    Route::post('logout', 'logout')->name('logout');
});

require __DIR__ . '/common.php';
