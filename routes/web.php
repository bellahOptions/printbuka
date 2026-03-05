<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

// ── TEMPORARY DIAGNOSTIC — REMOVE BEFORE PRODUCTION ─────────────────────────
// Visit /admin/image-diag to see exactly what image extensions are available.
Route::get('/admin/image-diag', function () {
    $gd = function_exists('imagecreatefromjpeg') ? gd_info() : null;

    return response()->json([
        'php_version'        => PHP_VERSION,
        'sapi'               => PHP_SAPI,

        // extension_loaded results (can lie on some hosts)
        'ext_loaded_gd'      => extension_loaded('gd'),
        'ext_loaded_imagick' => extension_loaded('imagick'),

        // function_exists is the reliable check
        'fn_imagecreatefromjpeg' => function_exists('imagecreatefromjpeg'),
        'fn_imagejpeg'           => function_exists('imagejpeg'),
        'fn_imagecreatefrompng'  => function_exists('imagecreatefrompng'),
        'fn_imagecreatefromgif'  => function_exists('imagecreatefromgif'),
        'fn_imagecreatefromwebp' => function_exists('imagecreatefromwebp'),
        'fn_imagecreatefrombmp'  => function_exists('imagecreatefrombmp'),
        'fn_imagecreatefromavif' => function_exists('imagecreatefromavif'),
        'fn_imagecreatefromstring' => function_exists('imagecreatefromstring'),
        'class_Imagick'          => class_exists('Imagick', false),

        // All loaded extensions filtered to image-related ones
        'loaded_extensions' => array_values(array_filter(
            get_loaded_extensions(),
            fn($e) => preg_match('/gd|imagick|image|exif|jpeg|png/i', $e)
        )),

        // Full GD info if available
        'gd_info' => $gd,
    ]);
});
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
