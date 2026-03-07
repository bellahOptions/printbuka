{{-- ── IT / Super Admin Dashboard ──────────────────────────────────────────
     Access: ALL data, ALL functions, ALL roles, NO limits
     ─────────────────────────────────────────────────────────────────────── --}}
     @section('title', 'IT department Dashboard')
     
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">System Overview, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-it);border-color:rgba(99,102,241,0.3)">⚡ Super Admin</span>
            <span class="pb-meta-tag">Full access · No restrictions</span>
        </div>
    </div>
    <div style="display:flex;gap:.625rem;flex-wrap:wrap">
        <a href="#" class="pb-btn pb-btn-ghost pb-btn-md">Activate Accounts <span class="pb-nav-badge danger" style="margin-left:.25rem">2</span></a>
        <a href="#" class="pb-btn pb-btn-primary pb-btn-md">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Job
        </a>
    </div>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat indigo"><div class="pb-stat-label">Active Jobs</div><div class="pb-stat-value">14</div><div class="pb-stat-sub">Across all phases</div></div>
    <div class="pb-stat gold"><div class="pb-stat-label">Pending Approvals</div><div class="pb-stat-value">3</div><div class="pb-stat-sub warn">Needs attention</div></div>
    <div class="pb-stat green"><div class="pb-stat-label">Revenue (Jan)</div><div class="pb-stat-value">₦2.4M</div><div class="pb-stat-sub up">↑ +18% MoM</div></div>
    <div class="pb-stat red"><div class="pb-stat-label">Pending Activations</div><div class="pb-stat-value">2</div><div class="pb-stat-sub">New registrations</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- All jobs table --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">All Active Jobs</div><div class="pb-card-subtitle">Full system view — all phases, amounts visible</div></div>
            <a href="#" class="pb-card-action">Job manager →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Client</th><th>Description</th><th>Phase</th><th>Amount</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $jobs=[
                        ['#PB-2501','TechCorp Ltd','Business Cards × 500','pb-badge-printing Printing','₦45,000'],
                        ['#PB-2502','Bloom Events','Event Banners × 10','pb-badge-design Design','₦120,000'],
                        ['#PB-2503','Lagos Foods','Menu Flyers × 1000','pb-badge-qc QC Review','₦38,500'],
                        ['#PB-2504','Grace Obi','Wedding Cards × 200','pb-badge-delivery Delivered','₦62,000'],
                        ['#PB-2505','ABC School','Branded Shirts × 50','pb-badge-pending Pending','₦95,000'],
                    ]; @endphp
                    @foreach($jobs as [$id,$client,$desc,$phase,$amount])
                    @php [$cls,$lbl]=explode(' ',$phase,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $desc }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                        <td class="pb-cell-mono" style="color:var(--pb-gold-lt)">{{ $amount }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Edit</a>
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Approve</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Staff pending activation --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Pending Activations</div><div class="pb-card-subtitle">New staff awaiting Super Admin approval</div></div>
            <span class="pb-nav-badge danger">2</span>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Name</th><th>Role</th><th>Registered</th><th>Email</th><th>Action</th></tr></thead>
                <tbody>
                    <tr>
                        <td class="pb-cell-strong">Amaka Okonkwo</td>
                        <td class="pb-cell-mono">Designer</td>
                        <td class="pb-cell-muted">Jan 28, 2025</td>
                        <td class="pb-cell-mono">amaka@example.com</td>
                        <td>
                            <div class="pb-cell-actions">
                                <button class="pb-btn pb-btn-success pb-btn-sm">Activate</button>
                                <button class="pb-btn pb-btn-danger pb-btn-sm">Reject</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pb-cell-strong">Taiwo Adeleke</td>
                        <td class="pb-cell-mono">Operations</td>
                        <td class="pb-cell-muted">Jan 29, 2025</td>
                        <td class="pb-cell-mono">taiwo@example.com</td>
                        <td>
                            <div class="pb-cell-actions">
                                <button class="pb-btn pb-btn-success pb-btn-sm">Activate</button>
                                <button class="pb-btn pb-btn-danger pb-btn-sm">Reject</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Evaluations --}}
    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Evaluation Overview</div><div class="pb-card-subtitle">2025 review cycle · all staff</div></div>
            <a href="{{ route('evaluation.show') }}" class="pb-card-action">All results →</a>
        </div>
        <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.75rem">
            @php $eval=[['Quality of Work',80,80],['Timeliness',62,62],['Communication',91,91],['Initiative',74,74],['Reliability',85,85]]; @endphp
            @foreach($eval as [$cat,$n,$pct])
            <div class="pb-rating-row">
                <span class="pb-rating-name">{{ $cat }}</span>
                <div class="pb-rating-track"><div class="pb-rating-fill" data-rating="{{ $pct }}%"></div></div>
                <span class="pb-rating-score">{{ $n }}%</span>
            </div>
            @endforeach
        </div>
    </div>

</div>
<div class="pb-col-right">

    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-profile-banner"></div>
        <div class="pb-profile-content">
            <div class="pb-profile-avatar-wrap">
                <div class="pb-avatar pb-avatar--lg pb-avatar--it" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">IT / Super Administrator</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.18 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.6a16 16 0 0 0 5.55 5.55l.96-.96a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 21 16.92z"/></svg>{{ $admin->phone }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-it">⚡ Super Admin</span>
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">System Activity</span><a href="#" class="pb-card-action">Audit log →</a></div>
        @php $acts=[['blue','Staff login','Ngozi Bello logged in','5m ago','<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/>'],['gold','Job approved','#PB-2503 moved to QC','12m ago','<polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>'],['green','Invoice paid','#INV-0089 marked paid','1h ago','<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>'],['red','Login failed','Unknown IP — blocked','2h ago','<circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>']] @endphp
        @foreach($acts as [$c,$t,$d,$tm,$i])
        <div class="pb-activity-item"><div class="pb-activity-icon {{ $c }}"><svg viewBox="0 0 24 24">{!! $i !!}</svg></div><div class="pb-activity-body"><div class="pb-activity-title">{{ $t }}</div><div class="pb-activity-desc">{{ $d }}</div></div><div class="pb-activity-time">{{ $tm }}</div></div>
        @endforeach
    </div>

    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header"><span class="pb-card-title">Announcements</span><a href="#" class="pb-card-action">Compose →</a></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ System</div><div class="pb-announce-title">2 Accounts Need Activation</div><div class="pb-announce-body">New staff awaiting your approval to access the system.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag info">🔒 Security</div><div class="pb-announce-title">Failed Login Detected</div><div class="pb-announce-body">Unusual activity from unknown IP. Blocked automatically.</div></div>
    </div>

</div>
</div>