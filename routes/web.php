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

    Route::prefix('register')->group(function () {
        view()->share([
            'main_key' => 'M2',
            'patientConfig' => config('site.patient'),
            'registerConfig' => config('site.register'),
        ]);

        // 전체 대상자 리스트
        Route::controller(\App\Http\Controllers\Register\RegisterController::class)->group(function () {
            Route::get('/', 'index')->name('register');
            Route::post('data', 'data')->name('register.data');
        });

        // Baseline
        Route::controller(\App\Http\Controllers\Register\BASE\BASEController::class)->prefix("BASE-{tab}")->whereIn('tab', array_keys(config("site.register.tab.BASE")))->group(function () {
            Route::get('{regist_num}', 'upsert')->name("register.BASE.upsert");
            Route::post('data', 'data')->name("register.BASE.data");
        });

        // Outcome
        Route::controller(\App\Http\Controllers\Register\OUT\OUTController::class)->prefix("OUT-{tab}")->whereIn('tab', array_keys(config("site.register.tab.OUT")))->group(function () {
            Route::get('{regist_num}', 'upsert')->name("register.OUT.upsert");
            Route::post('data', 'data')->name("register.OUT.data");
        });

        // Follow-up
        Route::controller(\App\Http\Controllers\Register\FU\FUController::class)->prefix("FU-{tab}")->group(function () {
            // register.FU : tab 은 LIST 만 허용
            Route::get('{regist_num}', 'index')
                ->where('tab', 'LIST')
                ->name("register.FU");

            // register.FU.upsert : tab 은 LIST 제외 전부 허용
            Route::get('{regist_num}/{FU_sid}', 'upsert')
                ->whereIn('tab', array_diff( array_keys(config("site.register.tab.FU")), ['LIST'] ))
                ->name("register.FU.upsert");

            // register.FU.data : tab 전체 허용
            Route::post('data', 'data')
                ->whereIn('tab', array_keys( config("site.register.tab.FU") ))
                ->name("register.FU.data");
        });

        // End of Study (Last F/U)
        Route::controller(\App\Http\Controllers\Register\END\ENDController::class)->prefix("END-{tab}")->whereIn('tab', array_keys(config("site.register.tab.END")))->group(function () {
            Route::get('{regist_num}', 'upsert')->name("register.END.upsert");
            Route::post('data', 'data')->name("register.END.data");
        });

        // Microbiome Data Upload
        Route::controller(\App\Http\Controllers\Register\FASTQ\FASTQController::class)->prefix("FASTQ-{tab}")->whereIn('tab', array_keys(config("site.register.tab.FASTQ")))->group(function () {
            Route::get('{regist_num}', 'upsert')->name("register.FASTQ.upsert");
            Route::post('data', 'data')->name("register.FASTQ.data");
        });
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
