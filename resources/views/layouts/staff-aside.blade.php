@php $admin = auth()->user(); @endphp

<aside class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('logo-dark.svg') }}" style="height:24px" alt="Printbuka" onerror="this.style.display='none'">
        
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">
            @if($admin->photo)
                <img src="{{ $admin->photo_url }}" alt="{{ $admin->full_name }}">
            @else
                {{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}
            @endif
        </div>
        <div style="min-width:0;flex:1">
            <div class="user-name">{{ $admin->first_name }} {{ $admin->last_name }}</div>
            <div class="user-role">{{ $admin->display_role }}</div>
        </div>
        <div class="status-dot"></div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>

        {{-- Dashboard (Everyone) --}}
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" width="20" height="20">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </span>
            <span>Dashboard</span>
        </a>

        {{-- Jobs (Role-based access) --}}
        @if(in_array($admin->staff_role, ['IT', 'Operations', 'Operations Manager', 'customer_service', 'Designer', 'QC', 'Finance']))
            <a href="{{ route('admin.jobs.index') }}" class="nav-item {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </span>
                <span>All Jobs</span>
                @if($admin->staff_role === 'QC' && ($pendingQcCount ?? 0))
                    <span class="nav-badge">{{ $pendingQcCount }}</span>
                @endif
            </a>
        @endif

        {{-- Designer Navigation --}}
        @if ($admin->staff_role === 'Designer')
            <a href="{{ route('admin.designer.pending') }}" class="nav-item {{ request()->routeIs('admin.designer.pending') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </span>
                <span>Pending Jobs</span>
                @if($pendingJobsCount ?? 0)
                    <span class="nav-badge">{{ $pendingJobsCount }}</span>
                @endif
            </a>
            
            <a href="{{ route('admin.designer.my-jobs') }}" class="nav-item {{ request()->routeIs('admin.designer.my-jobs') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </span>
                <span>My Jobs</span>
                @if($myJobsCount ?? 0)
                    <span class="nav-badge">{{ $myJobsCount }}</span>
                @endif
            </a>
        @endif

        {{-- Operations & QC Navigation --}}
        @if(in_array($admin->staff_role, ['Operations', 'Operations Manager', 'QC']))
            <a href="{{ route('admin.jobs.pending-approval') }}" class="nav-item {{ request()->routeIs('admin.jobs.pending-approval') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </span>
                <span>Pending {{ $admin->staff_role === 'QC' ? 'QC' : 'Approval' }}</span>
                @if($pendingApprovalCount ?? 0)
                    <span class="nav-badge">{{ $pendingApprovalCount }}</span>
                @endif
            </a>
        @endif

        {{-- Customer Service Navigation --}}
        @if($admin->staff_role === 'customer_service')
            <a href="{{ route('admin.invoices.index') }}" class="nav-item {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <line x1="8" y1="10" x2="16" y2="10"/>
                    </svg>
                </span>
                <span>Invoices</span>
                @if($pendingInvoicesCount ?? 0)
                    <span class="nav-badge">{{ $pendingInvoicesCount }}</span>
                @endif
            </a>
        @endif

        {{-- HR Navigation --}}
        @if ($admin->staff_role === 'HR' || $admin->isSuperAdmin())
            <div class="nav-section-label">HR</div>
            <a href="{{ route('admin.hr.staff-list') }}" class="nav-item {{ request()->routeIs('admin.hr.staff-list') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </span>
                <span>Staff List</span>
            </a>
            
            <a href="{{ route('admin.hr.attendance') }}" class="nav-item {{ request()->routeIs('admin.hr.attendance') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                        <circle cx="12" cy="15" r="1"/>
                        <circle cx="16" cy="15" r="1"/>
                        <circle cx="8" cy="15" r="1"/>
                    </svg>
                </span>
                <span>Attendance</span>
            </a>
            
            <a href="{{ route('admin.hr.performance') }}" class="nav-item {{ request()->routeIs('admin.hr.performance') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </span>
                <span>Performance</span>
            </a>
        @endif

        {{-- Finance Navigation --}}
        @if(in_array($admin->staff_role, ['Finance', 'IT']) || $admin->isSuperAdmin())
            <div class="nav-section-label">Finance</div>
            <a href="#" class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <line x1="12" y1="1" x2="12" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </span>
                <span>Cash Flow</span>
            </a>
            
            <a href="#" class="nav-item {{ request()->routeIs('admin.finance.invoices') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <line x1="8" y1="10" x2="16" y2="10"/>
                    </svg>
                </span>
                <span>Invoice Log</span>
            </a>
        @endif

        {{-- Performance (Everyone except HR/IT) --}}
        @if(!in_array($admin->staff_role, ['HR', 'IT']) || $admin->isSuperAdmin())
            <div class="nav-section-label">Personal</div>
            <a href="{{ route('admin.performance') }}" class="nav-item {{ request()->routeIs('admin.performance') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </span>
                <span>My Performance</span>
            </a>
        @endif

        {{-- System --}}
        <div class="nav-section-label">System</div>

        @if($admin->isSuperAdmin())
            <a href="{{ route('admin.activate-accounts') }}" class="nav-item {{ request()->routeIs('admin.activate-accounts') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                </span>
                <span>Activate Accounts</span>
                @if($pendingActivationsCount ?? 0)
                    <span class="nav-badge alert">{{ $pendingActivationsCount }}</span>
                @endif
            </a>
        @endif

        <a href="{{ route('admin.announcements') }}" class="nav-item {{ request()->routeIs('admin.announcements') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" width="20" height="20">
                    <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/>
                </svg>
            </span>
            <span>Announcements</span>
        </a>

        <a href="{{ route('admin.settings') }}" class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" width="20" height="20">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.07 4.93A10 10 0 0 0 4.93 19.07M4.93 4.93a10 10 0 0 0 14.14 14.14"/>
                </svg>
            </span>
            <span>Settings</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <span class="nav-icon" style="width:16px;height:16px;display:flex;align-items:center">
                    <svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </span>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</aside>