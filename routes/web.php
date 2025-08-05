<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/jobs', [HomeController::class, 'index'])->name('jobs.index');


Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);


Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/jobs/createjob', [JobController::class, 'create'])->name('jobs.createjob');

Route::middleware(['auth'])->group(function () {
    Route::get('savedlistJobs/index', function () {
        return view('savedlistJobs.index');
    })->name('merklisteIndex');
});
Route::middleware(['auth'])->group(function () {
    Route::get('jobs/create', function () {
        return view('jobs.create');
    })->name('jobs.create');
});

Route::middleware(['auth'])->group(function () {
 
    Route::get('/createjob', [JobController::class, 'createjob'])->name('createjob');
    Route::post('/createjob', [JobController::class, 'store'])->name('createjob.store');
});
Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->middleware('auth')->name('jobs.saved');
Route::middleware(['auth'])->group(function () {
    Route::post('/jobs/{id}/save', [JobController::class, 'saveJob'])->name('jobs.save');
    Route::get('/saved-jobs', [JobController::class, 'savedJobs'])->name('jobs.saved');
});

