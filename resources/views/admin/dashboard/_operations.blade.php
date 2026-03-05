{{-- ── Operations Dashboard ─────────────────────────────────────────────────
     Access: Job process · Phase approvals (manager) · Comments per phase
     No access: Invoice amounts / client payment info
     ─────────────────────────────────────────────────────────────────────── --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">Production Floor, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-ops);border-color:rgba(249,115,22,0.3)">● Operations</span>
            <span class="pb-meta-tag">Phase approvals active</span>
        </div>
    </div>
    <div class="pb-notice warn" style="margin:0;padding:.5rem .875rem">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Invoice amounts are hidden for this role
    </div>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat orange"><div class="pb-stat-label">Active Jobs</div><div class="pb-stat-value">8</div><div class="pb-stat-sub">On the floor</div></div>
    <div class="pb-stat gold"><div class="pb-stat-label">Awaiting Approval</div><div class="pb-stat-value">3</div><div class="pb-stat-sub warn">Needs manager sign-off</div></div>
    <div class="pb-stat green"><div class="pb-stat-label">Completed Today</div><div class="pb-stat-value">2</div><div class="pb-stat-sub up">On schedule</div></div>
    <div class="pb-stat red"><div class="pb-stat-label">Overdue</div><div class="pb-stat-value">1</div><div class="pb-stat-sub down">↓ Delayed</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Active job queue --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Active Job Queue</div><div class="pb-card-subtitle">Production floor — no invoice amounts shown</div></div>
            <a href="#" class="pb-card-action">All jobs →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Description</th><th>Current Phase</th><th>Assigned To</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $jobs=[
                        ['#PB-2501','Business Cards × 500','pb-badge-printing Printing','Ada Okafor'],
                        ['#PB-2502','Event Banners × 10','pb-badge-design Design','Ada Okafor'],
                        ['#PB-2503','Menu Flyers × 1000','pb-badge-qc QC Review','Ngozi Bello'],
                        ['#PB-2506','Branded Shirts × 50','pb-badge-pending Pre-Press','Unassigned'],
                    ]; @endphp
                    @foreach($jobs as [$id,$desc,$phase,$assign])
                    @php [$cls,$lbl]=explode(' ',$phase,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $desc }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                        <td class="pb-cell-muted">{{ $assign }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Details</a>
                                <a href="#" class="pb-btn pb-btn-success pb-btn-sm">Approve Phase</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Phase approval / timeline --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Job #PB-2501 — Phase Timeline</div><div class="pb-card-subtitle">Business Cards × 500 · TechCorp Ltd</div></div>
            <span class="pb-badge pb-badge-printing">Printing</span>
        </div>
        <div class="pb-timeline" style="margin-top:.75rem">
            @php
            $phases = [
                ['done',   'Job Received',   'Jan 20 · Ada Okafor',   false],
                ['done',   'Design',         'Jan 21 · Ada Okafor',   false],
                ['done',   'Pre-Press',      'Jan 22 · Segun A.',     false],
                ['active', 'Printing',       'In progress — Day 2',   true],
                ['pending','QC Review',      'Awaiting print done',   false],
                ['pending','Packaging',      '-',                     false],
                ['pending','Delivery',       '-',                     false],
            ];
            @endphp

            @foreach($phases as $i => [$state,$label,$meta,$canAct])
            <div class="pb-timeline-item">
                <div class="pb-timeline-track">
                    <div class="pb-timeline-dot {{ $state }}"></div>
                    @if($i < count($phases)-1)
                        <div class="pb-timeline-line"></div>
                    @endif
                </div>
                <div class="pb-timeline-content">
                    <div class="pb-timeline-title">{{ $label }}</div>
                    <div class="pb-timeline-meta">{{ $meta }}</div>

                    @if($canAct)
                    <div class="pb-phase-actions">
                        <textarea class="pb-comment-box" rows="2" placeholder="Add phase comment (optional)..." style="font-size:.6875rem"></textarea>
                        <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.5rem">
                            <button class="pb-btn pb-btn-success pb-btn-sm">
                                <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                Approve &amp; Advance
                            </button>
                            <button class="pb-btn pb-btn-danger pb-btn-sm">Return to Pre-Press</button>
                            <button class="pb-btn pb-btn-ghost pb-btn-sm">Save Comment</button>
                        </div>
                    </div>
                    @endif
                </div>
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
                <div class="pb-avatar pb-avatar--lg pb-avatar--ops" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Operations</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-ops">● Operations</span>
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">Awaiting My Approval</span><span class="pb-nav-badge gold">3</span></div>
        @php $approvals=[['#PB-2502','Design → Pre-Press','Event Banners × 10'],['#PB-2506','Pre-Press → Print','Branded Shirts × 50'],['#PB-2507','QC → Packaging','Letterheads × 300']]; @endphp
        @foreach($approvals as [$id,$transition,$desc])
        <div class="pb-activity-item">
            <div class="pb-activity-icon gold"><svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 0 0 1.946-.806 3.42 3.42 0 0 1 4.438 0 3.42 3.42 0 0 0 1.946.806 3.42 3.42 0 0 1 3.138 3.138 3.42 3.42 0 0 0 .806 1.946 3.42 3.42 0 0 1 0 4.438 3.42 3.42 0 0 0-.806 1.946 3.42 3.42 0 0 1-3.138 3.138 3.42 3.42 0 0 0-1.946.806 3.42 3.42 0 0 1-4.438 0 3.42 3.42 0 0 0-1.946-.806 3.42 3.42 0 0 1-3.138-3.138 3.42 3.42 0 0 0-.806-1.946 3.42 3.42 0 0 1 0-4.438 3.42 3.42 0 0 0 .806-1.946 3.42 3.42 0 0 1 3.138-3.138z"/></svg></div>
            <div class="pb-activity-body">
                <div class="pb-activity-title">{{ $id }} — {{ $transition }}</div>
                <div class="pb-activity-desc">{{ $desc }}</div>
            </div>
            <button class="pb-btn pb-btn-success pb-btn-sm">Approve</button>
        </div>
        @endforeach
    </div>

    <div class="pb-action-card pb-fade-up pb-delay-5">
        <div class="pb-action-eyebrow">◆ Manager Note</div>
        <div class="pb-action-title">Operations Manager approval required</div>
        <div class="pb-action-body">Phase transitions initiated by other staff need manager sign-off. 3 pending your review above.</div>
        <a href="#" class="pb-btn pb-btn-primary pb-btn-sm">Review All <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

</div>
</div>