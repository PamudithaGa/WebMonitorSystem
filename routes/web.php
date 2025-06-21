<?php

use App\Http\Controllers\PDFController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SeoController;


Route::view('/', 'common.monitor');
// ->middleware(['auth', 'verified'])
// ->name('dashboard');




// Route::view('/admin', 'admin.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');;

// Route::view('/superadmin', 'superadmin.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');;

Route::view('dashboard', 'superadmin.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::view('/monitor', 'common.monitor')->name('monitor');
Route::view('/ssl', 'common.ssl')->name('ssl');
Route::view('/visual', 'visualChecks.dashboard')->name('visualChecks');
Route::view('/reportsview', 'reports.reportDashboard')->name('reportsadmin');
Route::view('/monitordashboard', 'superadmin.dashboard')->name('adminDash');
Route::view('/reports', 'admin.dailyReports')->name('reports');
Route::view('/dash', 'seo.dashboard')->name('seo.dashboard');



Route::prefix('seo')->group(function () {
    Route::get('/dash', [SeoController::class, 'index'])->name('seo.dashboard');
    Route::post('/check', [SeoController::class, 'check'])->name('seo.check');
    Route::get('/report/{id}/pdf', [SeoController::class, 'generatePDF'])->name('seo.report.pdf');

    // Google OAuth
    Route::get('/google-auth', [SeoController::class, 'redirectToGoogle'])->name('seo.google.auth');
    Route::get('/oauth2callback', [SeoController::class, 'handleGoogleCallback']);
});


Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/report/download', [ReportController::class, 'download'])->name('report.download');
Route::get('/reports/daily', [ReportController::class, 'generateDailyReport']);
Route::get('/daily-summary', [SuperAdminController::class, 'dailySummary']);


//PDF Generator
Route::get('pdf', [PDFController::class, 'generateDailyPDF']);

Route::get('/admindashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->can('admin-access');

Route::get('/superadmindashboard', [SuperAdminController::class, 'dashboard'])
    ->middleware('auth')
    ->can('superadmin-access');


Gate::define('admin-access', function ($user) {
    return $user->role === 'admin';
});

Route::get('/analytics', [AnalyticsController::class, 'showTraffic']);

Route::view('/team', 'superadmin.teamManage')
    ->middleware(['auth', 'verified'])
    ->name('team');;


Route::get('/add-member', [SuperAdminController::class, 'showForm']);  // Show the form
Route::post('/add-member', [SuperAdminController::class, 'store']);

Route::post('/add-website', [AdminController::class, 'store'])->name('add.website');
Route::delete('/website/{id}', [SuperAdminController::class, 'destroy'])->name('website.destroy');
Route::get('/websites/{id}/edit', [AdminController::class, 'edit'])->name('website.edit');
Route::put('/websites/{id}', [AdminController::class, 'update'])->name('website.update');

require __DIR__ . '/auth.php';
