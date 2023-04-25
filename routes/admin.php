<?php

//Admin Dashboard Import
use App\Http\Controllers\Backend\Auth\ChangePasswordController;
//Admin Controller Import
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LogoutController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\ResetController;
use App\Http\Controllers\Backend\Page\DashboardController;
use App\Http\Controllers\Backend\Page\ProfileController;
//Import Admin Product Related Stuff
use App\Http\Controllers\Backend\Page\TeamsController;
use App\Http\Controllers\Backend\Page\EventsController;
use App\Http\Controllers\Backend\Page\ClassificationController;
use App\Http\Controllers\Backend\Page\TabulationController;
use App\Http\Controllers\Backend\Page\RankingController;
use App\Http\Controllers\Backend\Page\ScheduleController;

//Import Admin Transaction Stuff
use App\Http\Controllers\Backend\Users\CustomerController;
use App\Http\Controllers\Backend\Users\RoleController;
use App\Http\Controllers\Backend\Users\UsersController;

Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::resource('login', LoginController::class)->only(['index', 'store']);
        Route::resource('register', RegisterController::class)->only(['index', 'store']);
        Route::get('reset/password/{token}', [ResetController::class, 'ShowResetForm'])->name('reset.password.form');
        Route::post('reset/password', [ResetController::class, 'ResetPassword'])->name('reset.password');
        Route::resource('reset', ResetController::class)->only(['index', 'store']);
    });

    Route::middleware(['auth:web'])->group(function () {


        Route::middleware(['PreventBackHistory'])->group(function () {
            //Begin: Logout Module
            Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
            //End: Logout Module
            //Begin: Dashboard Module
            Route::resource('dashboard', DashboardController::class)->only(['index']);
            //End: Dashboard Module
            Route::resource('teams', TeamsController::class)->only(['index']);
            Route::resource('events', EventsController::class)->only(['index']);
            Route::resource('classification', ClassificationController::class)->only(['index','show']);
            Route::resource('overall', RankingController::class)->only(['index']);
            Route::resource('schedule', ScheduleController::class)->only(['index']);

            Route::get('/tabulation/create/{event}/{classification}', [TabulationController::class, 'create'])->name('tabulation.create');
            Route::resource('tabulation', TabulationController::class)->only(['index']);

            //Begin: Profile Module
            Route::get('/profile/changepassword', [ProfileController::class, 'changepass'])->name('AdminChangePass');
            Route::post('/profile/changepassword', [ProfileController::class, 'resetpass']);
            Route::resource('profile', ProfileController::class)->only('index');
            Route::resource('changepassword', ChangePasswordController::class)->only('index');
            //End: Profile Module

            //Begin: Reports Table
            Route::resource('report', ReportController::class);
            //End: Reports Table

            //Begin: Users Module
            Route::get('/user/archive', [UsersController::class, 'UserArchiveIndex'])->name('UserArchiveIndex');
            Route::resource('user', UsersController::class);
            Route::post('role/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('role/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
            Route::resource('role', RoleController::class);
            //End: Users Module

        });
    });
});
