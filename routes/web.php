<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::view('/', 'users.dashboard');
// ->middleware(['auth', 'verified'])
// ->name('dashboard');




// Route::view('/admin', 'admin.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');;

// Route::view('/superadmin', 'superadmin.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::view('/monitor', 'common.monitor');



Route::get('/admindashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->can('admin-access');

Route::get('/superadmindashboard', [SuperAdminController::class, 'dashboard'])
    ->middleware('auth')
    ->can('superadmin-access');


    Gate::define('admin-access', function ($user) {
        return $user->role === 'admin';
    });

Route::view('/team', 'superadmin.teamManage')
    ->middleware(['auth', 'verified'])
    ->name('team');;

require __DIR__ . '/auth.php';
