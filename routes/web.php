<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EvaluationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [PagesController::class, 'home'])->name('home');

Route::get('/evaluate-staff', [EvaluationController::class, 'create'])->name('evaluation.create');
Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');
Route::get('/evaluation/success', [EvaluationController::class, 'success'])->name('evaluation.success');

Route::get('/show/evaluation', [EvaluationController::class, 'show'])->name('evaluation.show');
Route::get('/show/evaluation/{id}', [EvaluationController::class, 'showDetail'])->name('evaluation.showDetail');