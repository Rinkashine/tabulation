<?php

use App\Http\Controllers\ColorSchemeController;
//Dark Mode and Color Switcher Import
//Import Customer Product and Cart ShippingController
use App\Http\Controllers\Frontend\HomeController;
//Import Order History
use App\Http\Controllers\Frontend\SchedulesController;
use Illuminate\Support\Facades\Route;



    Route::get('/TeamScore/{team}', [HomeController::class, 'TeamScoreIndex'])->name('TeamScore.show');
    Route::get('/EventScore', [HomeController::class, 'EventScoreIndex'])->name('EventScore.show');

    Route::get('/Schedule', [SchedulesController::class, 'ScheduleIndex'])->name('Schedules.show');
    Route::get('/', [Homecontroller::class, 'index'])->name('home');

    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Reoptimized class loader:
    Route::get('/optimize', function() {
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    });

    //Route cache:
    Route::get('/route-cache', function() {
        $exitCode = Artisan::call('route:cache');
        return '<h1>Routes cached</h1>';
    });

    //Clear Route cache:
    Route::get('/route-clear', function() {
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function() {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear Config cache:
    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    });


