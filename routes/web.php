<?php

use App\Models\User;
use App\Http\Controllers\cont;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Profile\ParametresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dashboard route

Route::middleware(['auth', 'role:Employé'])->group(function () {

    Route::resource('dashboard', 'App\Http\Controllers\DashboardController');

});


/***************************************** */
// start profile routes

Route::middleware(['auth', 'role:Employé'])->group(function () {
    Route::namespace('App\Http\Controllers\Profile')->group(function () {

        // parametres 
        Route::resource('parametres', 'ParametresController');

        // profile
        Route::resource('profile', 'ProfileController');

        // consultations
        Route::resource('consultations', 'ConsultationsController');

        // vaccination
        Route::resource('vaccination', 'VaccinationController');
    });

});

// update password from parametres
Route::middleware(['auth', 'role:Employé'])->group(function () {
    Route::namespace('App\Http\Controllers\Profile')->prefix('parametres')->name('update_password')->group(function () {
        Route::post('update_password', [ParametresController::class, 'update_password']);
    });
});

// end profile routes

// start notifications routes

Route::middleware(['auth', 'role:Employé'])->group(function () {
    Route::namespace('App\Http\Controllers')->group(function () {
        Route::resource('notifications', 'NotificationController');
    });
});

Route::middleware(['auth', 'role:Employé'])->group(function () {
    Route::namespace('App\Http\Controllers')->prefix('notifications')->name('notifications.markallread')->group(function () {
        Route::get('markAll', [NotificationController::class, 'MarkAllRead']);
    });
});

// end notifications routes
