{{-- ── Finance Dashboard ────────────────────────────────────────────────────
     Access: Invoices · Job payments · Amount paid · Finance operations
     Full financial visibility — ALL amounts visible
     ─────────────────────────────────────────────────────────────────────── --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">Finance Overview, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-finance);border-color:rgba(234,179,8,0.3)">● Finance</span>
            <span class="pb-meta-tag">Full financial access</span>
        </div>
    </div>
    <div style="display:flex;gap:.625rem;flex-wrap:wrap">
        <a href="#" class="pb-btn pb-btn-ghost pb-btn-md">
            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            Export Report
        </a>
        <a href="#" class="pb-btn pb-btn-primary pb-btn-md">
            <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            Record Payment
        </a>
    </div>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat yellow"><div class="pb-stat-label">Jan Revenue</div><div class="pb-stat-value">₦2.4M</div><div class="pb-stat-sub up">↑ +18% vs Dec</div></div>
    <div class="pb-stat green"><div class="pb-stat-label">Payments Received</div><div class="pb-stat-value">₦1.9M</div><div class="pb-stat-sub up">79% collected</div></div>
    <div class="pb-stat red"><div class="pb-stat-label">Outstanding</div><div class="pb-stat-value">₦520K</div><div class="pb-stat-sub down">5 invoices due</div></div>
    <div class="pb-stat blue"><div class="pb-stat-label">Invoices Issued</div><div class="pb-stat-value">14</div><div class="pb-stat-sub">This month</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Invoice table with amounts --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Invoice Register</div><div class="pb-card-subtitle">Full financial data — amounts visible</div></div>
            <a href="#" class="pb-card-action">All invoices →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Invoice #</th><th>Client</th><th>Job</th><th>Amount</th><th>Paid</th><th>Balance</th><th>Status</th></tr></thead>
                <tbody>
                    @php $invoices=[
                        ['INV-0089','TechCorp Ltd','Business Cards','₦45,000','₦45,000','₦0','pb-badge-complete Paid'],
                        ['INV-0090','Bloom Events','Event Banners','₦120,000','₦60,000','₦60,000','pb-badge-pending Part-Paid'],
                        ['INV-0091','Lagos Foods','Menu Flyers','₦38,500','₦0','₦38,500','pb-badge-returned Unpaid'],
                        ['INV-0092','Sunrise Clinic','Appt. Cards','₦22,000','₦22,000','₦0','pb-badge-complete Paid'],
                        ['INV-0093','Unity Bank','Promo Flyers','₦95,000','₦47,500','₦47,500','pb-badge-pending Part-Paid'],
                    ]; @endphp
                    @foreach($invoices as [$inv,$client,$job,$amount,$paid,$balance,$status])
                    @php [$cls,$lbl]=explode(' ',$status,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $inv }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $job }}</td>
                        <td class="pb-cell-mono" style="color:var(--pb-bright);font-weight:600">{{ $amount }}</td>
                        <td class="pb-cell-mono" style="color:var(--pb-green)">{{ $paid }}</td>
                        <td class="pb-cell-mono" style="color:{{ $balance === '₦0' ? 'var(--pb-muted)' : 'var(--pb-red)' }}">{{ $balance }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Payment recording + job amounts --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Job Payment Details</div><div class="pb-card-subtitle">Per-job financial breakdown</div></div>
            <a href="#" class="pb-card-action">Finance report →</a>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Client</th><th>Job Total</th><th>Amount Paid</th><th>Outstanding</th><th>Action</th></tr></thead>
                <tbody>
                    @php $payments=[
                        ['#PB-2501','TechCorp Ltd','₦45,000','₦45,000','₦0'],
                        ['#PB-2502','Bloom Events','₦120,000','₦60,000','₦60,000'],
                        ['#PB-2503','Lagos Foods','₦38,500','₦0','₦38,500'],
                        ['#PB-2505','ABC School','₦95,000','₦47,500','₦47,500'],
                    ]; @endphp
                    @foreach($payments as [$id,$client,$total,$paid,$outstanding])
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-mono" style="font-weight:600;color:var(--pb-bright)">{{ $total }}</td>
                        <td class="pb-cell-mono" style="color:var(--pb-green)">{{ $paid }}</td>
                        <td class="pb-cell-mono" style="color:{{ $outstanding === '₦0' ? 'var(--pb-muted)' : 'var(--pb-red)' }}">{{ $outstanding }}</td>
                        <td>
                            @if($outstanding !== '₦0')
                            <button class="pb-btn pb-btn-primary pb-btn-sm">Record Payment</button>
                            @else
                            <span class="pb-cell-muted">Settled</span>
                            @endif
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
                <div class="pb-avatar pb-avatar--lg pb-avatar--finance" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Finance Officer</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-finance">● Finance</span>
        </div>
    </div>

    {{-- Revenue summary card --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">Revenue Summary</span><a href="#" class="pb-card-action">Export →</a></div>
        <div style="padding:1.25rem;display:flex;flex-direction:column;gap:.875rem">
            @php $summary=[['January Revenue','₦2,400,000','yellow'],['Payments Collected','₦1,880,000','green'],['Outstanding Balance','₦520,000','red'],['Invoices Issued','14 invoices','blue'],['Avg. Job Value','₦171,429','gold']]; @endphp
            @foreach($summary as [$k,$v,$c])
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid var(--pb-rule)">
                <span style="font-size:.75rem;color:var(--pb-muted)">{{ $k }}</span>
                <span style="font-size:.875rem;font-family:var(--pb-font-mono);font-weight:700;color:var(--pb-{{ $c === 'yellow' ? 'gold-lt' : ($c === 'gold' ? 'gold-lt' : 'pb-'.$c) }})">{{ $v }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header"><span class="pb-card-title">Announcements</span><a href="#" class="pb-card-action">All</a></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ Follow-up</div><div class="pb-announce-title">₦147,500 outstanding</div><div class="pb-announce-body">2 clients (Bloom Events, ABC School) have partial payments due. Send reminders.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag success">💰 Target</div><div class="pb-announce-title">Jan target 80% reached</div><div class="pb-announce-body">₦2.4M of ₦3M monthly target collected. 5 days to close.</div></div>
    </div>

</div>
</div>