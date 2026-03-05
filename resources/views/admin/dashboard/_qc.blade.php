{{-- ── QC Dashboard ─────────────────────────────────────────────────────────
     Access: Job info · Client name · Delivery address · Final design
     Actions: Mark delivered · Return for critical review
     No access: Invoice amounts / payment info
     ─────────────────────────────────────────────────────────────────────── --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">QC Inspection, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-qc);border-color:rgba(6,182,212,0.3)">● Quality Control</span>
            <span class="pb-meta-tag">Payment data hidden</span>
        </div>
    </div>
    <div class="pb-notice warn" style="margin:0;padding:.5rem .875rem">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Invoice amounts are hidden for this role
    </div>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat cyan"><div class="pb-stat-label">Jobs for QC</div><div class="pb-stat-value">5</div><div class="pb-stat-sub">Awaiting inspection</div></div>
    <div class="pb-stat green"><div class="pb-stat-label">Passed Today</div><div class="pb-stat-value">3</div><div class="pb-stat-sub up">Cleared for delivery</div></div>
    <div class="pb-stat red"><div class="pb-stat-label">Returned</div><div class="pb-stat-value">1</div><div class="pb-stat-sub down">Critical review</div></div>
    <div class="pb-stat gold"><div class="pb-stat-label">Delivered</div><div class="pb-stat-value">12</div><div class="pb-stat-sub">This month</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Jobs for QC --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Jobs Awaiting QC</div><div class="pb-card-subtitle">Client info & delivery address visible — amounts hidden</div></div>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Client</th><th>Description</th><th>Delivery Address</th><th>QC Actions</th></tr></thead>
                <tbody>
                    @php $qcJobs=[
                        ['#PB-2503','Lagos Foods','Menu Flyers × 1000','12 Allen Ave, Ikeja, Lagos'],
                        ['#PB-2508','Sunrise Clinic','Appointment Cards × 500','8 Broad St, Lagos Island'],
                        ['#PB-2509','Unity Bank','Promo Flyers × 2000','Plot 22, Victoria Island'],
                    ]; @endphp
                    @foreach($qcJobs as [$id,$client,$desc,$addr])
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $desc }}</td>
                        <td class="pb-cell-muted" style="font-size:.6875rem">{{ $addr }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">View Design</a>
                                <button class="pb-btn pb-btn-success pb-btn-sm">Passed ✓</button>
                                <button class="pb-btn pb-btn-danger pb-btn-sm">Return</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Job detail panel with final design --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Job #PB-2503 — Design Review</div><div class="pb-card-subtitle">Lagos Foods · Menu Flyers × 1000</div></div>
            <span class="pb-badge pb-badge-qc">QC Review</span>
        </div>
        <div style="padding:1.25rem">
            {{-- Client info block --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-bottom:1.25rem">
                @php $info=[['Client','Lagos Foods'],['Contact','Chidi Nwosu'],['Phone','0801 234 5678'],['Address','12 Allen Ave, Ikeja, Lagos'],['Qty','1000 copies'],['Material','170gsm Art Paper']]; @endphp
                @foreach($info as [$k,$v])
                <div style="background:var(--pb-ink-4);border:1px solid var(--pb-rule);border-radius:var(--pb-radius);padding:.625rem .875rem">
                    <div style="font-size:.5625rem;font-family:var(--pb-font-mono);text-transform:uppercase;letter-spacing:.12em;color:var(--pb-muted);margin-bottom:.25rem">{{ $k }}</div>
                    <div style="font-size:.8125rem;font-weight:600;color:var(--pb-bright)">{{ $v }}</div>
                </div>
                @endforeach
            </div>

            {{-- Final design mockup area --}}
            <div style="background:var(--pb-ink-4);border:1px solid var(--pb-rule);border-radius:var(--pb-radius);padding:2rem;text-align:center;margin-bottom:1.25rem">
                <svg viewBox="0 0 24 24" style="width:32px;height:32px;stroke:var(--pb-muted);fill:none;stroke-width:1.5;margin:0 auto .75rem;display:block"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <div style="font-size:.8125rem;color:var(--pb-muted);margin-bottom:.5rem">Final Design File</div>
                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">
                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Download Final Design
                </a>
            </div>

            {{-- QC actions --}}
            <div class="pb-phase-actions">
                <textarea class="pb-comment-box" rows="2" placeholder="QC notes or reason for return..."></textarea>
                <div style="display:flex;gap:.625rem;flex-wrap:wrap;margin-top:.625rem">
                    <button class="pb-btn pb-btn-success pb-btn-md">
                        <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        Mark as Delivered
                    </button>
                    <button class="pb-btn pb-btn-danger pb-btn-md">Return for Critical Review</button>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="pb-col-right">

    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-profile-banner"></div>
        <div class="pb-profile-content">
            <div class="pb-profile-avatar-wrap">
                <div class="pb-avatar pb-avatar--lg pb-avatar--qc" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Quality Control</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-qc">● QC Staff</span>
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">Recent QC Actions</span></div>
        @php $acts=[['green','#PB-2499 Passed','Menu cards cleared','1h ago'],['green','#PB-2500 Delivered','Delivered to client','3h ago'],['red','#PB-2497 Returned','Colour mismatch — critical','1d ago']]; @endphp
        @foreach($acts as [$c,$t,$d,$tm])
        <div class="pb-activity-item"><div class="pb-activity-icon {{ $c }}"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div><div class="pb-activity-body"><div class="pb-activity-title">{{ $t }}</div><div class="pb-activity-desc">{{ $d }}</div></div><div class="pb-activity-time">{{ $tm }}</div></div>
        @endforeach
    </div>

    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header"><span class="pb-card-title">Announcements</span><a href="#" class="pb-card-action">All</a></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ QC Note</div><div class="pb-announce-title">New paper stock arrived</div><div class="pb-announce-body">New 170gsm matte available. Update your QC checks accordingly.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag success">✅ Policy</div><div class="pb-announce-title">QC checklist updated</div><div class="pb-announce-body">Colour tolerance guide revised. See shared folder for details.</div></div>
    </div>

</div>
</div>