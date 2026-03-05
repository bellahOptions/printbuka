{{-- ── Designer Dashboard ───────────────────────────────────────────────────
     Access: Job brief/info · Feedback · Upload design (auto-emails client)
     No access: Invoice amounts / payment info
     ─────────────────────────────────────────────────────────────────────── --}}
<div class="pb-page-header pb-fade-up pb-delay-1">
    <div>
        <div class="pb-greeting-eyebrow" data-greeting="true">Good morning</div>
        <h1 class="pb-greeting-title">Creative Studio, <em>{{ $admin->first_name }}</em></h1>
        <div class="pb-meta-tags">
            <span class="pb-meta-tag" style="color:var(--role-design);border-color:rgba(168,85,247,0.3)">● Designer</span>
            <span class="pb-meta-tag">Upload triggers client email</span>
            <span class="pb-meta-tag">Payment data hidden</span>
        </div>
    </div>
    <a href="#" class="pb-btn pb-btn-primary pb-btn-md">
        <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
        Upload Design
    </a>
</div>

<div class="pb-stats pb-stats-4 pb-fade-up pb-delay-2">
    <div class="pb-stat violet"><div class="pb-stat-label">My Active Briefs</div><div class="pb-stat-value">4</div><div class="pb-stat-sub">Assigned to me</div></div>
    <div class="pb-stat gold"><div class="pb-stat-label">Awaiting Feedback</div><div class="pb-stat-value">2</div><div class="pb-stat-sub warn">Client review</div></div>
    <div class="pb-stat green"><div class="pb-stat-label">Uploaded This Week</div><div class="pb-stat-value">3</div><div class="pb-stat-sub up">Emails sent ✓</div></div>
    <div class="pb-stat red"><div class="pb-stat-label">Revision Requests</div><div class="pb-stat-value">1</div><div class="pb-stat-sub down">Client feedback</div></div>
</div>

<div class="pb-layout-2col">
<div class="pb-col-left">

    {{-- Job briefs --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div><div class="pb-card-title">My Job Briefs</div><div class="pb-card-subtitle">Assigned jobs — no payment data visible</div></div>
        </div>
        <div class="pb-table-wrap">
            <table class="pb-table">
                <thead><tr><th>Job ID</th><th>Client</th><th>Description</th><th>Status</th><th>Deadline</th><th>Actions</th></tr></thead>
                <tbody>
                    @php $briefs=[
                        ['#PB-2502','Bloom Events','Event Banners × 10','pb-badge-design In Progress','Jan 30'],
                        ['#PB-2510','Kano Farms','Packaging Labels × 500','pb-badge-pending Brief Received','Feb 2'],
                        ['#PB-2511','Unity Co.','Logo Redesign','pb-badge-review Awaiting Client','Feb 5'],
                        ['#PB-2512','Grace Obi','Wedding Invitation Cards','pb-badge-returned Revision Req.','Jan 31'],
                    ]; @endphp
                    @foreach($briefs as [$id,$client,$desc,$status,$dead])
                    @php [$cls,$lbl]=explode(' ',$status,2); @endphp
                    <tr>
                        <td class="pb-cell-mono">{{ $id }}</td>
                        <td class="pb-cell-strong">{{ $client }}</td>
                        <td class="pb-cell-muted">{{ $desc }}</td>
                        <td><span class="pb-badge {{ $cls }}">{{ $lbl }}</span></td>
                        <td class="pb-cell-mono">{{ $dead }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <a href="#" class="pb-btn pb-btn-ghost pb-btn-sm">Brief</a>
                                <a href="#" class="pb-btn pb-btn-primary pb-btn-sm">Upload</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Upload design panel --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div><div class="pb-card-title">Upload Design — Job #PB-2502</div><div class="pb-card-subtitle">Bloom Events · Event Banners × 10</div></div>
            <span class="pb-badge pb-badge-design">In Design</span>
        </div>
        <div style="padding:1.25rem">
            <div class="pb-notice info" style="margin-bottom:1.25rem">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                Uploading a design will automatically email the client with a preview link for approval.
            </div>

            {{-- Drop zone --}}
            <div style="border:2px dashed var(--pb-rule-2);border-radius:var(--pb-radius);padding:2.5rem;text-align:center;margin-bottom:1.25rem;transition:border-color .15s;cursor:pointer" onmouseenter="this.style.borderColor='var(--role-design)'" onmouseleave="this.style.borderColor='var(--pb-rule-2)'">
                <svg viewBox="0 0 24 24" style="width:36px;height:36px;stroke:var(--pb-muted);fill:none;stroke-width:1.25;margin:0 auto .875rem;display:block"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <div style="font-size:.875rem;font-weight:600;color:var(--pb-body);margin-bottom:.375rem">Drop design files here</div>
                <div style="font-size:.6875rem;color:var(--pb-muted);margin-bottom:1rem">PDF, AI, PSD, PNG — Max 50MB per file</div>
                <label class="pb-btn pb-btn-ghost pb-btn-sm" style="cursor:pointer">
                    <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                    Browse Files
                    <input type="file" style="display:none" accept=".pdf,.ai,.psd,.png,.jpg">
                </label>
            </div>

            {{-- Feedback textarea --}}
            <div style="margin-bottom:1rem">
                <label style="font-size:.625rem;font-family:var(--pb-font-mono);text-transform:uppercase;letter-spacing:.12em;color:var(--pb-muted);display:block;margin-bottom:.5rem">Design Notes / Feedback for Client</label>
                <textarea class="pb-comment-box" rows="3" placeholder="Add design notes, version info, or instructions for the client..."></textarea>
            </div>

            <div style="display:flex;gap:.625rem;flex-wrap:wrap">
                <button class="pb-btn pb-btn-primary pb-btn-md">
                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                    Upload & Notify Client
                </button>
                <button class="pb-btn pb-btn-ghost pb-btn-md">Save Draft</button>
            </div>
        </div>
    </div>

</div>
<div class="pb-col-right">

    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-profile-banner"></div>
        <div class="pb-profile-content">
            <div class="pb-profile-avatar-wrap">
                <div class="pb-avatar pb-avatar--lg pb-avatar--design" style="border:2px solid var(--pb-ink-3)">
                    @if($admin->photo)<img src="{{ $admin->photo_url }}" alt="">@else{{ strtoupper(substr($admin->first_name,0,1).substr($admin->last_name,0,1)) }}@endif
                </div>
            </div>
            <div class="pb-profile-name">{{ $admin->full_name }}</div>
            <div class="pb-profile-role">Graphic Designer</div>
            <div class="pb-profile-detail"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>{{ $admin->email }}</div>
            <hr class="pb-profile-divider">
            <span class="pb-badge pb-badge-role-design">● Designer</span>
        </div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header"><span class="pb-card-title">Client Feedback</span><span class="pb-nav-badge gold">2</span></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">🔄 Revision</div><div class="pb-announce-title">#PB-2512 — Grace Obi</div><div class="pb-announce-body">"Please change the font to something more elegant and make the floral border thicker."</div></div>
        <div class="pb-announce"><div class="pb-announce-tag success">✅ Approved</div><div class="pb-announce-title">#PB-2509 — Unity Bank</div><div class="pb-announce-body">Client approved design. Ready to move to pre-press.</div></div>
    </div>

    <div class="pb-card pb-fade-up pb-delay-5">
        <div class="pb-card-header"><span class="pb-card-title">Announcements</span><a href="#" class="pb-card-action">All</a></div>
        <div class="pb-announce"><div class="pb-announce-tag info">🎨 Assets</div><div class="pb-announce-title">Brand Kit Updated</div><div class="pb-announce-body">New Printbuka brand assets and logo variants added to shared drive.</div></div>
        <div class="pb-announce"><div class="pb-announce-tag urgent">⚡ Deadline</div><div class="pb-announce-title">Grace Obi revision due Jan 31</div><div class="pb-announce-body">Wedding card revision must be submitted before end of day tomorrow.</div></div>
    </div>

</div>
</div>