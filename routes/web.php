<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/evaluate-staff', [EvaluationController::class, 'create'])->name('evaluation.create');
Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
Route::get('/evaluation/success', [EvaluationController::class, 'success'])->name('evaluation.success');

Route::get('/show/evaluation', [EvaluationController::class, 'show'])->name('evaluation.show');
Route::get('/show/evaluation/{id}', [EvaluationController::class, 'showDetail'])->name('evaluation.showDetail');

//JOB ROUTES
Route::get('/job', function () {
    return view('job');
})->name('job');

Route::get('/job/create', function () {
    return view('job.create');
})->name('job.create');
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
