<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AttendanceController;
//use App\Http\Controllers\Admin\InvoiceController;
//use App\Http\Controllers\Admin\StaffController;

Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'authenticate'])->name('admin.login.post');
// Onboarding route
Route::post('/admin/onboard/now', [AdminController::class, 'onboardNow'])->name('onboard.staff');
Route::get('/admin/onboarding', [App\Http\Controllers\AdminController::class, 'onboarding'])->name('admin.onboarding');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::post('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

Route::get('/admin/verify-email/{token}', [AdminController::class, 'verifyEmail'])
    ->name('admin.verify.email');

Route::middleware(['auth:admin', \App\Http\Middleware\EnsureAdminIsActive::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/performance', [AdminController::class, 'performance'])->name('admin.performance');
    Route::get('/admin/performance/{id}', [AdminController::class, 'performanceDetail'])->name('admin.performance.detail');

    //announcement
    Route::get('/admin/announcements', [AdminController::class, 'announcements'])->name('admin.announcements');
    Route::get('/admin/announcements/create', [AdminController::class, 'createAnnouncement'])->name('admin.announcements.create');
    Route::post('/admin/announcements', [AdminController::class, 'storeAnnouncement'])->name('admin.announcements.store');
    Route::get('/admin/announcements/{id}/edit', [AdminController::class, 'editAnnouncement'])->name('admin.announcements.edit');
    Route::put('/admin/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.announcements.update');

    //MANAGE USERS
    Route::get('admin/manage/users', [AdminController::class, 'openUserManagement'])->name('manage-users');
    Route::post('staff/{id}/activate', [AdminController::class, 'activateStaff'])->name('admin.activate');
    Route::post('staff/{id}/reject', [AdminController::class, 'rejectStaff'])->name('admin.reject');
    Route::post('staff/{id}/deactivate', [AdminController::class, 'deactivateStaff'])->name('admin.deactivate');

    //JOB MANAGEMENT
    Route::get('/admin/jobs/create', [JobController::class, 'create'])->name('create.jobs');
    Route::get('/admin/jobs/show', [JobController::class, 'show'])->name('jobs.show');
    Route::post('/admin/jobs/edit/{$id}', [JobController::class, 'update'])->name('jobs.edit');
    Route::post('/admin/jobs/delete/{$id}', [JobController::class, 'delete'])->name('jobs.destroy');

    Route::get('/admin/jobs/invoice/create/{$id}', [JobController::class, 'update'])->name('invoice.create');

    //SETTINGS
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Jobs
    Route::resource('jobs', JobController::class);
    Route::post('/jobs/{job}/comments', [JobController::class, 'addComment'])->name('jobs.comment');
    Route::post('/jobs/comments/{comment}/approve', [JobController::class, 'approveComment'])->name('jobs.comments.approve');
    
    // Designer specific
    Route::get('/designer/pending', [JobController::class, 'pending'])->name('designer.pending');
    Route::get('/designer/my-jobs', [JobController::class, 'myJobs'])->name('designer.my-jobs');
    
    // Pending approvals
    Route::get('/jobs/pending-approval', [JobController::class, 'pendingApproval'])->name('jobs.pending-approval');
    
    // Invoices
   // Route::resource('invoices', InvoiceController::class);
    
    // HR
    //Route::prefix('hr')->name('hr.')->group(function () {
       // Route::get('/staff-list', [StaffController::class, 'index'])->name('staff-list');
       // Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
      //  Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    //    Route::get('/performance', [StaffController::class, 'performance'])->name('performance');
   // });
   
    // Finance
    //Route::prefix('finance')->name('finance.')->group(function () {
      //  Route::get('/cash-flow', [FinanceController::class, 'cashFlow'])->name('cash-flow');
      //  Route::get('/invoices', [InvoiceController::class, 'log'])->name('invoices');
    //});
    
    // Performance
    //Route::get('/performance', [PerformanceController::class, 'index'])->name('performance');
    
    // Super Admin only
   // Route::middleware(['can:super-admin'])->group(function () {
      //  Route::get('/activate-accounts', [StaffController::class, //'pendingActivation'])->name('activate-accounts');
        //Route::post('/activate-accounts/{admin}', [StaffController::class, 'activate'])->name('activate');
    //});
    
    // Settings
    //Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    //Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    
    // Announcements
    //Route::resource('announcements', AnnouncementController::class);
    
    // Logout
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');


});

Route::get('/test-admin-middleware', function() {
    return 'Middleware is working!';
})->middleware('admin');