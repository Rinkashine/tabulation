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


