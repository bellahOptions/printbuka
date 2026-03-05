<?php
// app/Http/Middleware/SuperAdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = Auth::guard('admin')->user();
        
        if (!$admin->isSuperAdmin()) {
            abort(403, 'Unauthorized. Super Admin access required.');
        }

        return $next($request);
    }
}