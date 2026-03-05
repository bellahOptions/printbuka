{{-- ── HR Dashboard ──────────────────────────────────────────────────────────
     Access: Staff info · Announcements · Monthly evaluations · Job info (read-only)
     No access: Critical job actions · Invoice amounts
     ─────────────────────────────────────────────────────────────────────── --}}

{{-- Page header --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">Welcome, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-hr);border-color:rgba(236,72,153,0.3)">● Human Resources</span>
            <span class="pb-meta-tag">2025 Review Cycle</span>
        </div>
    </div>
    <a href="{{ route('evaluation.create') }}" class="pb-btn pb-btn-primary pb-btn-md">
        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        New Evaluation
    </a>
</div>

{{-- Stats --}}
<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat pink">
        <div class="pb-stat-label">Total Staff</div>
        <div class="pb-stat-value">12</div>
        <div class="pb-stat-sub">Active accounts</div>
    </div>
    <div class="pb-stat gold">
        <div class="pb-stat-label">Pending Evaluations</div>
        <div class="pb-stat-value">4</div>
        <div class="pb-stat-sub warn">Deadline Jan 31</div>
    </div>
    <div class="pb-stat green">
        <div class="pb-stat-label">Completed Reviews</div>
        <div class="pb-stat-value">8</div>
        <div class="pb-stat-sub up">↑ 67% done</div>
    </div>
    <div class="pb-stat blue">
        <div class="pb-stat-label">Announcements</div>
        <div class="pb-stat-value">2</div>
        <div class="pb-stat-sub">Unread</div>
    </div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Staff list --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">Staff Directory</div>
                <div class="pb-card-subtitle">All active accounts</div>
            </div>
            <a href="#" class="pb-card-action">View all →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Evaluation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $staffDemo = [
                        ['Ada Okafor','Designer','active','complete'],
                        ['Chukwu Emeka','Operations','active','pending'],
                        ['Ngozi Bello','QC','active','complete'],
                        ['Segun Adeyemi','Customer Service','active','pending'],
                        ['Funmilayo Eze','Finance','active','in-progress'],
                    ];
                    $statusMap = ['active'=>'pb-badge-active','inactive'=>'pb-badge-returned'];
                    $evalMap   = ['complete'=>'pb-badge-complete','pending'=>'pb-badge-pending','in-progress'=>'pb-badge-review'];
                    @endphp
                    @foreach($staffDemo as [$name,$role,$status,$eval])
                    <tr>
                        <td class="pb-cell-strong">{{ $name }}</td>
                        <td class="pb-cell-mono">{{ $role }}</td>
                        <td><span class="pb-badge {{ $statusMap[$status] }}">{{ ucfirst($status) }}</span></td>
                        <td><span class="pb-badge {{ $evalMap[$eval] }}">{{ ucfirst(str_replace('-',' ',$eval)) }}</span></td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">View</a>
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Evaluate</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Monthly evaluation summary --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">Monthly Evaluation Data</div>
                <div class="pb-card-subtitle">January 2025 cycle</div>
            </div>
            <a href="{{ route('evaluation.show') }}" class="pb-card-action">All results →</a>
        </div>
        <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.75rem">
            @php
            $evalData = [
                ['Quality of Work', '78%', 78],
                ['Timeliness', '62%', 62],
                ['Communication', '91%', 91],
                ['Initiative', '74%', 74],
                ['Team Attitude', '85%', 85],
            ];
            @endphp
            <div style="font-size:.5625rem;font-family:var(--pb-font-mono);letter-spacing:.15em;text-transform:uppercase;color:var(--pb-muted);margin-bottom:.25rem">Team Average Scores</div>
            @foreach($evalData as [$cat,$pct,$num])
            <div class="pb-rating-row">
                <span class="pb-rating-name">{{ $cat }}</span>
                <div class="pb-rating-track"><div class="pb-rating-fill" data-rating="{{ $num }}%"></div></div>
                <span class="pb-rating-score">{{ $pct }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Job info (read-only) --}}
    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">Job Overview</div>
                <div class="pb-card-subtitle">Read-only view — HR cannot perform production actions</div>
            </div>
        </div>
        <div style="padding:1rem 1.25rem">
            <div class="pb-notice info">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                You have read-only access to job information. Critical actions (approvals, phase changes) are restricted to Operations staff.
            </div>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Client</th><th>Description</th><th>Phase</th></tr></thead>
                <tbody>
                    @php $jobs=[['#PB-2501','TechCorp Ltd','Business Cards × 500','pb-badge-printing Printing'],['#PB-2502','Bloom Events','Event Banners × 10','pb-badge-design Design'],['#PB-2503','Lagos Foods','Menu Flyers × 1000','pb-badge-qc QC Review']]; @endphp
                    @foreach($jobs as [$id,$client,$desc,$phase])
                    @php [$cls,$lbl]=explode(' ',$phase,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $desc }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="pb-col-right">

    {{-- Profile card --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-profile-banner"></div>
        <div class="pb-profile-content">
            <div class="pb-profile-avatar-wrap">
                <div class="pb-avatar pb-avatar--lg pb-avatar--hr" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Human Resources</div>
            <div class="pb-profile-detail">
                <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                {{ $admin->email }}
            </div>
            <div class="pb-profile-detail">
                <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 5.55 5.55l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 21 16.92z"/></svg>
                {{ $admin->phone }}
            </div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-hr">● HR Staff</span>
        </div>
    </div>

    {{-- Announcements --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <span class="pb-card-title">Announcements</span>
            <a href="#" class="pb-card-action">All</a>
        </div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ Urgent</div><div class="pb-announce-title">Evaluation Deadline — Jan 31</div><div class="pb-announce-body">All staff must complete the 2025 performance evaluation. 4 pending.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag info">💰 Pay</div><div class="pb-announce-title">Salary Review In Progress</div><div class="pb-announce-body">HR is reviewing all compensation structures. Results by Feb 15.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag success">🎉 Team</div><div class="pb-announce-title">Q4 2024 Strong Performance</div><div class="pb-announce-body">Printbuka's best quarter. Thank you all.</div></div>
    </div>

    {{-- CTA --}}
    <div class="pb-action-card pb-fade-up pb-delay-5">
        <div class="pb-action-eyebrow">◆ Action Required</div>
        <div class="pb-action-title">4 staff evaluations pending</div>
        <div class="pb-action-body">The January review cycle closes on Jan 31. Send reminders to outstanding staff members.</div>
        <a href="#" class="pb-btn pb-btn-primary pb-btn-sm">Send Reminders
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>

</div>
</div>