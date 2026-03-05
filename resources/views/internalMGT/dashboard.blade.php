@extends('layouts.staff')
@section('content')
{{-- MAIN --}}
<div class="main">
    <header class="topbar">
        <div class="breadcrumb">
            <span>Printbuka</span>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">dashboard</span>
        </div>
        <div class="topbar-right">
            <div class="topbar-date" id="top-date"></div>
            <div class="icon-btn" title="Notifications">
                <svg viewBox="0 0 24 24"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/></svg>
                <span class="notif-dot"></span>
            </div>
            <div class="icon-btn" title="Search">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <div class="topbar-avatar">
                @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="{{ $admin->full_name }}">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
            </div>
        </div>
    </header>

    <div class="content">

        {{-- Page Header --}}
        <div class="page-header fade-up">
            <div>
                <div class="greeting-label" id="greeting-label">Good morning</div>
                <h1 class="greeting-name">Welcome back, <em>{{ $admin->first_name }}</em></h1>
                <div class="header-meta">
                    <span class="header-meta-tag">Today's Date {{ date('Y-m-d') }}</span>
                    <span class="header-meta-tag">{{ $admin->display_role }}</span>
                    @if($admin->isSuperAdmin())<span class="header-meta-tag" style="color:var(--gold);border-color:var(--gold-dim)">⚡ Super Admin</span>@endif
                </div>
            </div>            
            <a href="{{ route('evaluation.create') }}" class="cta-btn">
                Check Jobs
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        {{-- Stats --}}
        <div class="stats-strip fade-up">
            <div class="stat-cell gold">
                <div class="stat-label">Pending Jobs</div>
                <div class="stat-value">16</div>
                <div class="stat-sub">Updated {{ date('M/d') }}</div>
            </div>
            <div class="stat-cell ember">
                <div class="stat-label">Total Revelnue</div>
                <div class="stat-value">₦423,354.90</div>
                <div class="stat-sub up">↑ +0.4 from last</div>
            </div>
            <div class="stat-cell jade">
                <div class="stat-label">Active Staff</div>
                <div class="stat-value">12</div>
                <div class="stat-sub">Registered accounts</div>
            </div>
            <div class="stat-cell blue">
                <div class="stat-label">HR Notices</div>
                <div class="stat-value">3</div>
                <div class="stat-sub" style="color:#60a5fa">2 unread</div>
            </div>
        </div>

        {{-- Grid --}}
        <div class="main-grid">

            <div class="left-col">

                {{-- Pending Jobs Progress Summary --}}
                         {{-- Activity --}}
                <div class="card fade-up">
                    <div class="card-header flex flex-row items-center justify-between">
                        <span class="card-title">Ongoing Jobs</span>
                        <a href="#" class="card-action">All Jobs →</a>
                    </div>                    
                    <div class="activity-item">
                        <div class="activity-icon"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
</svg>
</div>
                        <div class="activity-body">
                            <div class="activity-title">Flyer Design</div>
                            <div class="activity-desc">CHurch Flier design, 200copies of A4 card</div>
                        </div>
                        <div class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">Production Stage</div>
                    </div>
                </div>


                {{-- Activity --}}
                <div class="card fade-up">
                    <div class="card-header">
                        <span class="card-title">Recent Activity</span>
                        <a href="#" class="card-action">All activity →</a>
                    </div>
                    @php $activities=[
                        ['gold','Evaluation form opened','Started 2025 review — Section 3 in progress','2h ago','<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/>'],
                        ['jade','Profile updated','Email and phone number updated successfully','3d ago','<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
                        ['blue','Announcement read','Q3 salary review update from HR department','1w ago','<path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/>'],
                        ['gray','Account activated','Welcome to the Printbuka Staff Portal','Jan 5','<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
                    ]; @endphp
                    @foreach($activities as [$type,$title,$desc,$time,$icon])
                    <div class="activity-item">
                        <div class="activity-icon {{ $type }}"><svg viewBox="0 0 24 24">{!! $icon !!}</svg></div>
                        <div class="activity-body">
                            <div class="activity-title">{{ $title }}</div>
                            <div class="activity-desc">{{ $desc }}</div>
                        </div>
                        <div class="activity-time">{{ $time }}</div>
                    </div>
                    @endforeach
                </div>

                {{-- Quick Actions --}}
                <div class="card fade-up">
                    <div class="card-header"><span class="card-title">Quick Actions</span></div>
                    <div class="quick-grid">
                        <a href="{{ route('evaluation.create') }}" class="quick-btn">
                            <div class="quick-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                            <span class="quick-label">Complete Evaluation</span>
                        </a>
                        <a href="#" class="quick-btn">
                            <div class="quick-icon"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                            <span class="quick-label">Edit Profile</span>
                        </a>
                        <a href="#" class="quick-btn">
                            <div class="quick-icon" style="color:var(--ember)"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 5.55 5.55l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 21 16.92z"/></svg></div>
                            <span class="quick-label">Contact HR</span>
                        </a>
                        <a href="#" class="quick-btn">
                            <div class="quick-icon" style="color:#60a5fa"><svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></div>
                            <span class="quick-label">View Documents</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="right-col">

                {{-- Profile --}}
                <div class="card fade-up">
                    <div class="profile-banner"><div class="profile-banner-pattern"></div></div>
                    <div class="profile-content">
                        <div class="profile-avatar-wrap">
                            <div class="profile-avatar">
                                @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="{{ $admin->full_name }}">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                            </div>
                        </div>
                        <div class="profile-name">{{ $admin->full_name }}</div>
                        <div class="profile-role">{{ $admin->display_role }}</div>
                        <div class="profile-detail">
                            <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            {{ $admin->email }}
                        </div>
                        <div class="profile-detail">
                            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 5.55 5.55l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 21 16.92z"/></svg>
                            {{ $admin->phone }}
                        </div>
                        <hr class="profile-divider">
                        @php
                        $bc=match($admin->admin_status){'super_admin'=>'super','manager'=>'manager',default=>'staff'};
                        $bt=match($admin->admin_status){'super_admin'=>'⚡ Super Admin','manager'=>'★ Manager',default=>'● Staff'};
                        @endphp
                        <span class="role-badge {{ $bc }}">{{ $bt }}</span>
                    </div>
                </div>

                {{-- Announcements --}}
                <div class="card fade-up">
                    <div class="card-header">
                        <span class="card-title">Announcements</span>
                        <a href="#" class="card-action">All</a>
                    </div>
                    <div class="announce-item">
                        <div class="announce-tag urgent">⚡ Urgent</div>
                        <div class="announce-title">Evaluation Deadline — Jan 31</div>
                        <div class="announce-body">All staff must complete the 2025 performance evaluation form before the deadline.</div>
                    </div>
                    <div class="announce-item">
                        <div class="announce-tag pay">💰 Compensation</div>
                        <div class="announce-title">Salary Review In Progress</div>
                        <div class="announce-body">HR is reviewing all compensation structures. Results published by Feb 15.</div>
                    </div>
                    <div class="announce-item">
                        <div class="announce-tag team">🎉 Company</div>
                        <div class="announce-title">Q4 2024 Strong Performance</div>
                        <div class="announce-body">Printbuka's best quarter on record. Thank you to every member of the team.</div>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="action-card fade-up">
                    <div class="action-eyebrow">◆ Action Required</div>
                    <div class="action-title">Evaluation 43% complete</div>
                    <div class="action-body">Approximately 10 minutes remaining. Don't miss the January 31 deadline to be included in the salary review.</div>
                    <a href="{{ route('evaluation.create') }}" class="action-btn">
                        Complete Now
                        <svg viewBox="0 0 24 24" style="width:10px;height:10px;stroke:currentColor;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection