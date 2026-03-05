<?php
// app/Http/Middleware/PreventAdminAccess.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        // If user is logged in as admin, don't allow them to access client pages
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('warning', 'Please use the admin panel.');
        }

        return $next($request);
    }
}