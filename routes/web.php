<?php

use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard.index'))
        ->middleware('module.access:Dashboard')
        ->name('dashboard');

    Route::get('/file-maintenance', [WorkspaceController::class, 'fileMaintenance'])
        ->middleware('module.access:File Maintenance')
        ->name('file-maintenance');

    Route::get('/profile', [WorkspaceController::class, 'profile'])
        ->middleware('module.access:Profile')
        ->name('profile');

    Route::get('/job-application', [WorkspaceController::class, 'jobApplications'])
        ->middleware('module.access:Job Application')
        ->name('job-application');

    Route::get('/job-posting', [WorkspaceController::class, 'jobPostings'])
        ->middleware('module.access:Job Posting')
        ->name('job-posting');

    Route::get('/settings', [WorkspaceController::class, 'settings'])
        ->middleware('module.access:Settings')
        ->name('settings');
});

require __DIR__.'/auth.php';
