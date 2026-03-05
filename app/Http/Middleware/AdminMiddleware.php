<?php
// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the admin area.');
        }

        $admin = Auth::guard('admin')->user();
        
        if (!$admin->is_active) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->with('error', 'Your account is not activated. Please contact Super Admin.');
        }

        if (!$admin->hasVerifiedEmail()) {
            return redirect()->route('admin.verification.notice')->with('error', 'Please verify your email first.');
        }

        return $next($request);
    }
}