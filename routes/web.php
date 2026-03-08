<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('home', function () {
    return view('home');
})->name('home');

//Page ROUTES
Route::get('/about-printbuka', [PagesController::class, 'aboutPage'])->name('about');
//SERVICES ROUTES
Route::get('/printbuka-services', [PagesController::class, 'servicesPage'])->name('services');
Route::get('/printbuka-services/UV-DTF', [PagesController::class, 'uvdtf'])->name('uv-dtf');
Route::get('/printbuka-services/directImage', [PagesController::class, 'directImage'])->name('directImage');
Route::get('/printbuka-services/DTF', [PagesController::class, 'dtf'])->name('dtf');
Route::get('/printbuka-services/engraving', [PagesController::class, 'engravePage'])->name('engraving');
//Othe page routes
Route::get('/shop-printbuka', [PagesController::class, 'shopPage'])->name('shop');
Route::get('/printbuka-blog', [BlogController::class, 'blogPage'])->name('blog.index');
Route::get('/about-printbuka', [PagesController::class, 'aboutPage'])->name('about');

Route::get('/blog',[BlogController::class,'index'])->name('blog.index');
Route::get('/blog/{slug}',[BlogController::class,'show'])->name('blog.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//JOB ROUTES
Route::get('/job', function () {
    return view('job');
})->name('job');

Route::get('/job/create', function () {
    return view('job.create');
})->name('job.create');
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
