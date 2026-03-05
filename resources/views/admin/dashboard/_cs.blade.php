{{-- ── Customer Service Dashboard ───────────────────────────────────────────
     Access: Customer data · Job info · Invoice management · Job card management
     Actions: Issue job card · Issue invoice
     ─────────────────────────────────────────────────────────────────────── --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">Customer Desk, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-cs);border-color:rgba(34,197,94,0.3)">● Customer Service</span>
            <span class="pb-meta-tag">Invoice & Job Card access</span>
        </div>
    </div>
    <div style="display:flex;gap:.625rem;flex-wrap:wrap">
        <a href="#" class="pb-btn pb-btn-ghost pb-btn-md">
            <svg viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><path d="M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2"/></svg>
            New Job Card
        </a>
        <a href="#" class="pb-btn pb-btn-primary pb-btn-md">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Issue Invoice
        </a>
    </div>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat green"><div class="pb-stat-label">Customers</div><div class="pb-stat-value">48</div><div class="pb-stat-sub up">↑ 3 new this week</div></div>
    <div class="pb-stat gold"><div class="pb-stat-label">Open Jobs</div><div class="pb-stat-value">7</div><div class="pb-stat-sub">In production</div></div>
    <div class="pb-stat blue"><div class="pb-stat-label">Invoices Issued</div><div class="pb-stat-value">14</div><div class="pb-stat-sub">This month</div></div>
    <div class="pb-stat orange"><div class="pb-stat-label">Pending Follow-up</div><div class="pb-stat-value">3</div><div class="pb-stat-sub warn">Need attention</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Customers table --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Customer Directory</div><div class="pb-card-subtitle">All registered clients</div></div>
            <a href="#" class="pb-card-action">All customers →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Name</th><th>Phone</th><th>Total Jobs</th><th>Last Order</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $customers=[
                        ['TechCorp Ltd','0801 234 5678',8,'Jan 20, 2025'],
                        ['Bloom Events','0802 345 6789',3,'Jan 18, 2025'],
                        ['Lagos Foods','0803 456 7890',12,'Jan 22, 2025'],
                        ['Sunrise Clinic','0804 567 8901',5,'Jan 15, 2025'],
                        ['Grace Obi','0805 678 9012',2,'Jan 10, 2025'],
                    ]; @endphp
                    @foreach($customers as [$name,$phone,$jobs,$last])
                    <tr>
                        <td class="pb-cell-strong">{{ $name }}</td>
                        <td class="pb-cell-mono">{{ $phone }}</td>
                        <td class="pb-cell-mono" style="text-align:center">{{ $jobs }}</td>
                        <td class="pb-cell-muted">{{ $last }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">View</a>
                                <a href="#" class="pb-btn pb-btn-primary pb-btn-sm">New Job</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Job cards --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Job Cards</div><div class="pb-card-subtitle">Issue & manage job cards for production</div></div>
            <a href="#" class="pb-card-action">All job cards →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job Card #</th><th>Client</th><th>Description</th><th>Status</th><th>Invoice</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $cards=[
                        ['JC-0089','TechCorp Ltd','Business Cards × 500','pb-badge-printing In Production','INV-0089'],
                        ['JC-0090','Bloom Events','Event Banners × 10','pb-badge-design Design','INV-0090'],
                        ['JC-0091','Lagos Foods','Menu Flyers × 1000','pb-badge-qc QC','INV-0091'],
                        ['JC-0092','ABC School','Branded Shirts × 50','pb-badge-pending Pending','—'],
                    ]; @endphp
                    @foreach($cards as [$jc,$client,$desc,$status,$inv])
                    @php [$cls,$lbl]=explode(' ',$status,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $jc }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $desc }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                        <td class="pb-cell-mono">{{ $inv }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Edit</a>
                                @if($inv === '—')
                                <a href="#" class="pb-btn pb-btn-primary pb-btn-sm">Issue Invoice</a>
                                @else
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">View Invoice</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="pb-col-right">

    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-profile-banner"></div>
        <div class="pb-profile-content">
            <div class="pb-profile-avatar-wrap">
                <div class="pb-avatar pb-avatar--lg pb-avatar--cs" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Customer Service</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-cs">● Customer Service</span>
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">Recent Activity</span></div>
        @php $acts=[['green','Invoice issued','INV-0091 — Lagos Foods','20m ago'],['blue','New customer','TechCorp Ltd registered','2h ago'],['gold','Job card created','JC-0092 — ABC School','3h ago'],['orange','Follow-up needed','Bloom Events — no response','1d ago']]; @endphp
        @foreach($acts as [$c,$t,$d,$tm])
        <div class="pb-activity-item"><div class="pb-activity-icon {{ $c }}"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><div class="pb-activity-body"><div class="pb-activity-title">{{ $t }}</div><div class="pb-activity-desc">{{ $d }}</div></div><div class="pb-activity-time">{{ $tm }}</div></div>
        @endforeach
    </div>

    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header"><span class="pb-card-title">Announcements</span><a href="#" class="pb-card-action">All</a></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ Pricing</div><div class="pb-announce-title">New Price List Effective Feb 1</div><div class="pb-announce-body">Updated pricing for all print categories. Use new rates for new invoices from Feb 1.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag info">📋 Process</div><div class="pb-announce-title">Invoice template updated</div><div class="pb-announce-body">New invoice layout approved by finance. Download from shared drive.</div></div>
    </div>

</div>
</div>