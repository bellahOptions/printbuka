<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ensures the authenticated admin has:
 *   1. A verified email address
 *   2. Been activated by a SuperAdmin (is_active = true)
 *
 * This runs AFTER auth:admin so $admin is guaranteed non-null here.
 */
class EnsureAdminIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (! $admin) {
            return redirect()->route('admin.login');
        }

        if (! $admin->hasVerifiedEmail()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Please verify your email address.']);
        }

        if (! $admin->is_active) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')
                ->withErrors(['email' => 'Your account is pending activation by a SuperAdmin.']);
        }

        return $next($request);
    }
}
