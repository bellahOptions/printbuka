{{--
    Printbuka Admin Dashboard — Role-Aware Master Layout
    ─────────────────────────────────────────────────────
    Resolves the correct nav + content partial based on $admin->staff_role.
    The CSS design system lives in resources/css/printbuka.css — paste into app.css.
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')— {{ config('app.name', 'Printbuka') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">

{{-- ── Resolve role ────────────────────────────────────────────────────────── --}}
@php
    $role     = strtolower($admin->staff_role ?? 'staff');
    $isIT     = $admin->isSuperAdmin() || $role === 'it';

    // Canonical role key for CSS classes and partial lookup
    $roleKey  = match(true) {
        $isIT                          => 'it',
        $role === 'hr'                 => 'hr',
        str_contains($role,'operation')=> 'operations',
        $role === 'qc'                 => 'qc',
        str_contains($role,'customer') => 'cs',
        str_contains($role,'design')   => 'designer',
        str_contains($role,'finance')  => 'finance',
        default                        => 'staff',
    };

    // Nav definitions per role — [icon-path, label, route-name-or-#, badge?]
    $navMap = [
        'hr' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2|M23 21v-2a4 4 0 0 0-3-3.87|M16 3.13a4 4 0 0 1 0 7.75', 'Staff Information', '#', null],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', '2'],
                ['M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2|M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2|M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2', 'Monthly Evaluations', '#', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'Job Information', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
                ['M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'Change Password', '#', null],
            ],
        ],
        'it' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z|M14 2v6h6|M16 13H8|M16 17H8|M10 9H8', 'Evaluations', '#', null],
                ['M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2|M23 21v-2a4 4 0 0 0-3-3.87|M16 3.13a4 4 0 0 1 0 7.75', 'Staff Management', '#', null],
                ['M22 12h-4l-3 9L9 3l-3 9H2', 'Performance', '#', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'All Jobs', '#', '7'],
                ['M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'Finance Overview', '#', null],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'admin' => [
                ['M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z', 'Activate Accounts', 'manage-users', '!'],
                ['M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z|M12 9v4|M12 17h.01', 'System Alerts', '#', '3'],
                ['M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z|M12 8v4l3 3', 'Audit Log', '#', null],
                ['M3 3h18v18H3z|M3 9h18|M9 21V9', 'Settings', '#', null],
            ],
        ],
        'operations' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'Active Jobs', '#', '3'],
                ['M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z|M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16', 'Job Queue', '#', null],
                ['M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 0 0 1.946-.806 3.42 3.42 0 0 1 4.438 0 3.42 3.42 0 0 0 1.946.806 3.42 3.42 0 0 1 3.138 3.138 3.42 3.42 0 0 0 .806 1.946 3.42 3.42 0 0 1 0 4.438 3.42 3.42 0 0 0-.806 1.946 3.42 3.42 0 0 1-3.138 3.138 3.42 3.42 0 0 0-1.946.806 3.42 3.42 0 0 1-4.438 0 3.42 3.42 0 0 0-1.946-.806 3.42 3.42 0 0 1-3.138-3.138 3.42 3.42 0 0 0-.806-1.946 3.42 3.42 0 0 1 0-4.438 3.42 3.42 0 0 0 .806-1.946 3.42 3.42 0 0 1 3.138-3.138z', 'Phase Approvals', '#', '2'],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
            ],
        ],
        'qc' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'Jobs for QC', '#', '5'],
                ['M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 0 0 1.946-.806 3.42 3.42 0 0 1 4.438 0 3.42 3.42 0 0 0 1.946.806 3.42 3.42 0 0 1 3.138 3.138 3.42 3.42 0 0 0 .806 1.946 3.42 3.42 0 0 1 0 4.438 3.42 3.42 0 0 0-.806 1.946 3.42 3.42 0 0 1-3.138 3.138 3.42 3.42 0 0 0-1.946.806 3.42 3.42 0 0 1-4.438 0 3.42 3.42 0 0 0-1.946-.806 3.42 3.42 0 0 1-3.138-3.138 3.42 3.42 0 0 0-.806-1.946 3.42 3.42 0 0 1 0-4.438 3.42 3.42 0 0 0 .806-1.946 3.42 3.42 0 0 1 3.138-3.138z', 'Mark Delivered', '#', null],
                ['M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z|M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6z', 'Final Designs', '#', null],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
            ],
        ],
        'cs' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2|M12 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8z', 'Customers', '#', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'Jobs', '#', '3'],
                ['M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2|M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2|M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2', 'Job Cards', '#', null],
                ['M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z|M14 2v6h6|M16 13H8|M16 17H8|M10 9H8', 'Invoices', '#', '1'],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
            ],
        ],
        'designer' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'My Job Briefs', '#', '4'],
                ['M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z', 'Give Feedback', '#', null],
                ['M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4|M17 8l-5-5-5 5|M12 3v12', 'Upload Design', '#', null],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
            ],
        ],
        'finance' => [
            'main' => [
                ['M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z', 'Dashboard', 'admin.dashboard', null],
                ['M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z|M14 2v6h6|M16 13H8|M16 17H8', 'Invoices', '#', null],
                ['M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z', 'Job Payments', '#', null],
                ['M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z', 'Finance Summary', '#', null],
                ['M22 12h-4l-3 9L9 3l-3 9H2', 'Reports', '#', null],
                ['M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0', 'Announcements', '#', null],
            ],
            'settings' => [
                ['M12 20h9|M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z', 'My Profile', '#', null],
            ],
        ],
    ];

    $nav = $navMap[$roleKey] ?? $navMap['hr'];

    // Role display label
    $roleLabel = match($roleKey) {
        'it'         => 'IT / Super Admin',
        'hr'         => 'Human Resources',
        'operations' => 'Operations',
        'qc'         => 'Quality Control',
        'cs'         => 'Customer Service',
        'designer'   => 'Designer',
        'finance'    => 'Finance',
        default      => 'Staff',
    };
@endphp

<div class="pb-shell">

    {{-- ══ MOBILE BACKDROP ══ --}}
    <div class="pb-sidebar-backdrop" id="pb-backdrop" onclick="closeSidebar()"></div>

    {{-- ══ SIDEBAR ══ --}}
    <aside class="pb-sidebar" id="pb-sidebar">

        {{-- Brand --}}
        <div class="pb-brand">
            <img src="{{ asset('logo-dark.svg') }}" style="height:22px" alt="Printbuka"
                 onerror="this.style.display='none'">
        </div>

        {{-- User pill --}}
        <div class="pb-user-pill">
            <div class="pb-avatar pb-avatar--md pb-avatar--{{ $roleKey }}">
                @if($admin->photo)
                    <img src="{{ asset('storage/photos/' . $admin->photo) }}" alt="{{ $admin->first_name }}" style="width:50px; height:50px; object-fit:cover;" />
                @else
                    {{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}
                @endif
            </div>
            <div class="pb-user-info">
                <div class="pb-user-name">{{ $admin->first_name }} {{ $admin->last_name }}</div>
                <div class="pb-user-role">{{ $roleLabel }}</div>
            </div>
            <div class="pb-user-status"></div> 
        </div>

        {{-- Nav --}}
        <nav class="pb-nav" role="navigation" aria-label="Main navigation">

            {{-- Main section --}}
            <div class="pb-section-label">Main</div>

            @foreach($nav['main'] as $item)
                @php
                    $isActive = ($item[2] !== '#') && request()->routeIs($item[2]);
                    $href     = ($item[2] !== '#') ? route($item[2]) : '#';
                    $paths    = explode('|', $item[0]);
                @endphp
                <a href="{{ $href }}"
                   class="pb-nav-item {{ $isActive ? 'active role-'.$roleKey : '' }}"
                   {{ $isActive ? 'aria-current=page' : '' }}>
                    <span class="pb-nav-icon">
                        <svg viewBox="0 0 24 24">
                            @foreach($paths as $p)<path d="{{ $p }}"/>@endforeach
                        </svg>
                    </span>
                    <span class="pb-nav-label">{{ $item[1] }}</span>
                    @if($item[3])
                        <span class="pb-nav-badge {{ $item[3] === '!' ? 'danger' : '' }}">{{ $item[3] }}</span>
                    @endif
                </a>
            @endforeach

            {{-- Secondary section --}}
            @if(isset($nav['admin']) || isset($nav['settings']))
            <div class="pb-section-label" style="margin-top:0.5rem">
                {{ isset($nav['admin']) ? 'Admin' : 'Account' }}
            </div>

            @foreach(($nav['admin'] ?? $nav['settings'] ?? []) as $item)
                @php $paths = explode('|', $item[0]); @endphp
                <a href="{{ ($item[2] !== '#') ? route($item[2]) : '#' }}"
                   class="pb-nav-item">
                    <span class="pb-nav-icon">
                        <svg viewBox="0 0 24 24">
                            @foreach($paths as $p)<path d="{{ $p }}"/>@endforeach
                        </svg>
                    </span>
                    <span class="pb-nav-label">{{ $item[1] }}</span>
                    @if($item[3])
                        <span class="pb-nav-badge {{ $item[3] === '!' ? 'danger' : '' }}">{{ $item[3] }}</span>
                    @endif
                </a>
            @endforeach
            @endif

        </nav>

        {{-- Logout --}}
        <div class="pb-sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="pb-logout-btn">
                    <span class="pb-nav-icon" style="width:1.125rem;height:1.125rem;display:flex;align-items:center">
                        <svg viewBox="0 0 24 24" style="width:.875rem;height:.875rem;stroke:currentColor;fill:none;stroke-width:1.75;stroke-linecap:round;stroke-linejoin:round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                    </span>
                    <span class="pb-nav-label">Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <div class="pb-main">

        {{-- Topbar --}}
        <header class="pb-topbar">
            <div style="display:flex;align-items:center;gap:0.75rem;min-width:0">
                {{-- Mobile menu toggle --}}
                <button class="pb-menu-toggle" onclick="openSidebar()" aria-label="Open menu">
                    <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>

                <div class="pb-breadcrumb">
                    <span>Printbuka</span>
                    <span class="pb-breadcrumb-sep">/</span>
                    <span class="pb-breadcrumb-current">dashboard</span>
                </div>
            </div>

            <div class="pb-topbar-right">
                <div class="pb-topbar-date" id="pb-date"></div>

                {{-- Role pill --}}
                <span class="pb-role-pill {{ $roleKey }}">{{ $roleLabel }}</span>

                {{-- Notifications --}}
                <div class="pb-icon-btn" role="button" aria-label="Notifications">
                    <svg viewBox="0 0 24 24"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                    <span class="pb-notif-dot"></span>
                </div>

                {{-- Avatar --}}
                <div class="pb-avatar pb-avatar--sm pb-avatar--{{ $roleKey }}">
                    @if($admin->photo)
                        <img src="{{ $admin->photo_url }}" alt="{{ $admin->full_name }}">
                    @else
                        {{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}
                    @endif
                </div>
            </div>
        </header>

        {{-- ── Role-specific content ── --}}
        <div class="pb-content">
            @include('admin.dashboard._' . $roleKey, ['roleLabel' => $roleLabel, 'roleKey' => $roleKey])
            @yield('content')
        </div>

    </div>{{-- /pb-main --}}
</div>{{-- /pb-shell --}}

<script>
// Date
document.getElementById('pb-date').textContent =
    new Date().toLocaleDateString('en-GB',{weekday:'short',day:'numeric',month:'short',year:'numeric'});

// Greeting helper (available to partials)
window.pbGreeting = () => {
    const h = new Date().getHours();
    return h < 12 ? 'Good morning' : h < 17 ? 'Good afternoon' : 'Good evening';
};
document.querySelectorAll('.pb-greeting-eyebrow').forEach(el => {
    if (el.dataset.greeting) el.textContent = window.pbGreeting();
});

// Sidebar mobile toggle
function openSidebar()  { document.getElementById('pb-sidebar').classList.add('open'); document.getElementById('pb-backdrop').classList.add('open'); }
function closeSidebar() { document.getElementById('pb-sidebar').classList.remove('open'); document.getElementById('pb-backdrop').classList.remove('open'); }

// Progress bars & rating fills — triggered after paint
window.addEventListener('load', () => {
    document.querySelectorAll('[data-progress]').forEach(el => {
        setTimeout(() => { el.style.width = el.dataset.progress; }, 400);
    });
    document.querySelectorAll('[data-rating]').forEach((el,i) => {
        setTimeout(() => { el.style.width = el.dataset.rating; }, 500 + i * 70);
    });
});
</script>
</body>
</html>