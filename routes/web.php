<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::view('/', 'common.monitor');
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


Route::view('/monitor', 'common.monitor')->name('monitor');
Route::view('/ssl', 'common.ssl')->name('ssl');
Route::view('/reports', 'admin.reports')->name('reports');
Route::view('/monitordashboard', 'superadmin.dashboard')->name('adminDash');


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


Route::get('/add-member', [SuperAdminController::class, 'showForm']);  // Show the form
Route::post('/add-member', [SuperAdminController::class, 'store']); 

// Route::post('/add-website', [AdminController::class, 'store']) ; 
Route::post('/add-website', [AdminController::class, 'store'])->name('add.website');

Route::delete('/website/{id}', [SuperAdminController::class, 'destroy'])->name('website.destroy');
require __DIR__ . '/auth.php';
