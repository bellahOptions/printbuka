<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — {{ config('app.name', 'Printbuka') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root{--ink:#0a0a0a;--ink-2:#111111;--ink-3:#1a1a1a;--ink-4:#242424;--rule:#2a2a2a;--rule-2:#333333;--muted:#666666;--dim:#999999;--body:#c8c8c8;--bright:#f0ece4;--gold:#d4a843;--gold-dim:#8a6c28;--gold-glow:rgba(212,168,67,0.12);--ember:#c8420a;--ember-dim:rgba(200,66,10,0.12);--jade:#2a7a5a;--jade-dim:rgba(42,122,90,0.12)}
        *{box-sizing:border-box;margin:0;padding:0}
        body{background:var(--ink);color:var(--body);font-family:'DM Sans',sans-serif;display:flex;height:100vh;overflow:hidden}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");opacity:.025;pointer-events:none;z-index:9999}

        /* SIDEBAR */
        .sidebar{width:220px;flex-shrink:0;background:var(--ink-2);border-right:1px solid var(--rule);display:flex;flex-direction:column;height:100vh;position:relative;z-index:10}
        .sidebar-brand{padding:20px 20px 18px;border-bottom:1px solid var(--rule);display:flex;align-items:center;gap:10px}
        .brand-wordmark{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:var(--bright);letter-spacing:-.3px}
        .brand-dot{color:var(--gold)}
        .sidebar-user{margin:14px 14px 6px;background:var(--ink-3);border:1px solid var(--rule);border-radius:4px;padding:12px;display:flex;align-items:center;gap:10px}
        .user-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--ember));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:#000;flex-shrink:0;font-family:'DM Mono',monospace;overflow:hidden}
        .user-avatar img{width:36px;height:36px;border-radius:50%;object-fit:cover}
        .user-name{font-size:12px;font-weight:600;color:var(--bright);line-height:1.2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .user-role{font-size:10px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-family:'DM Mono',monospace}
        .status-dot{width:6px;height:6px;border-radius:50%;background:#4ade80;margin-left:auto;flex-shrink:0;box-shadow:0 0 6px rgba(74,222,128,.6);animation:pulse-green 2s ease-in-out infinite}
        @keyframes pulse-green{0%,100%{opacity:1;box-shadow:0 0 6px rgba(74,222,128,.6)}50%{opacity:.7;box-shadow:0 0 12px rgba(74,222,128,.3)}}
        .nav-section-label{font-size:9px;letter-spacing:2.5px;text-transform:uppercase;color:var(--rule-2);font-weight:600;padding:16px 20px 6px;font-family:'DM Mono',monospace}
        .nav-item{display:flex;align-items:center;gap:10px;padding:9px 14px 9px 18px;margin:1px 8px;border-radius:3px;font-size:12.5px;color:var(--muted);text-decoration:none;transition:all .15s;position:relative;font-weight:500}
        .nav-item:hover{background:var(--ink-3);color:var(--bright)}
        .nav-item.active{background:var(--gold-glow);color:var(--gold);border-left:2px solid var(--gold);padding-left:16px}
        .nav-icon{width:16px;height:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .nav-icon svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
        .nav-badge{margin-left:auto;background:var(--gold);color:#000;font-size:9px;font-weight:700;padding:1px 6px;border-radius:20px;font-family:'DM Mono',monospace}
        .nav-badge.alert{background:var(--ember);color:#fff}
        .sidebar-nav{flex:1;overflow-y:auto;padding-bottom:8px}
        .sidebar-nav::-webkit-scrollbar{width:0}
        .sidebar-footer{padding:12px 8px;border-top:1px solid var(--rule)}
        .logout-btn{display:flex;align-items:center;gap:10px;width:100%;padding:9px 14px 9px 18px;border-radius:3px;font-size:12.5px;color:var(--muted);background:none;border:none;cursor:pointer;transition:all .15s;font-family:'DM Sans',sans-serif;font-weight:500}
        .logout-btn:hover{background:rgba(200,66,10,.08);color:#f87171}

        /* TOPBAR */
        .main{flex:1;display:flex;flex-direction:column;overflow:hidden}
        .topbar{height:52px;background:var(--ink-2);border-bottom:1px solid var(--rule);display:flex;align-items:center;justify-content:space-between;padding:0 28px;flex-shrink:0}
        .breadcrumb{display:flex;align-items:center;gap:8px;font-size:11px;color:var(--muted);font-family:'DM Mono',monospace}
        .breadcrumb-sep{color:var(--rule-2)}
        .breadcrumb-current{color:var(--dim)}
        .topbar-right{display:flex;align-items:center;gap:16px}
        .topbar-date{font-family:'DM Mono',monospace;font-size:10px;color:var(--muted)}
        .icon-btn{width:32px;height:32px;background:var(--ink-3);border:1px solid var(--rule);border-radius:4px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;position:relative;color:var(--muted)}
        .icon-btn svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
        .icon-btn:hover{border-color:var(--gold);color:var(--gold)}
        .notif-dot{position:absolute;top:7px;right:7px;width:5px;height:5px;background:var(--gold);border-radius:50%}
        .topbar-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--ember));display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;color:#000;font-family:'DM Mono',monospace;overflow:hidden;border:1px solid var(--rule-2)}
        .topbar-avatar img{width:100%;height:100%;object-fit:cover}

        /* CONTENT */
        .content{flex:1;overflow-y:auto;padding:28px 32px 48px}
        .content::-webkit-scrollbar{width:4px}
        .content::-webkit-scrollbar-track{background:transparent}
        .content::-webkit-scrollbar-thumb{background:var(--rule-2);border-radius:2px}

        /* PAGE HEADER */
        .page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;padding-bottom:24px;border-bottom:1px solid var(--rule);gap:16px}
        .greeting-label{font-family:'DM Mono',monospace;font-size:10px;color:var(--muted);text-transform:uppercase;letter-spacing:2px;margin-bottom:6px}
        .greeting-name{font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:var(--bright);line-height:1.1}
        .greeting-name em{font-style:italic;color:var(--gold)}
        .header-meta{display:flex;align-items:center;gap:8px;margin-top:8px;flex-wrap:wrap}
        .header-meta-tag{font-size:10px;font-family:'DM Mono',monospace;color:var(--muted);background:var(--ink-3);border:1px solid var(--rule);padding:3px 8px;border-radius:2px}
        .cta-btn{display:inline-flex;align-items:center;gap:8px;background:var(--gold);color:#000;font-size:11px;font-weight:700;padding:10px 20px;border-radius:3px;text-decoration:none;letter-spacing:.3px;transition:all .2s;white-space:nowrap;flex-shrink:0}
        .cta-btn:hover{background:#e6ba55;transform:translateY(-1px);box-shadow:0 8px 24px rgba(212,168,67,.25)}
        .cta-btn svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}

        /* STATS STRIP */
        .stats-strip{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--rule);border:1px solid var(--rule);border-radius:4px;overflow:hidden;margin-bottom:24px}
        .stat-cell{background:var(--ink-2);padding:18px 20px;position:relative;overflow:hidden;transition:background .15s}
        .stat-cell:hover{background:var(--ink-3)}
        .stat-cell::before{content:'';position:absolute;top:0;left:0;right:0;height:2px}
        .stat-cell.gold::before{background:var(--gold)}
        .stat-cell.ember::before{background:var(--ember)}
        .stat-cell.jade::before{background:#4ade80}
        .stat-cell.blue::before{background:#60a5fa}
        .stat-label{font-size:9px;font-family:'DM Mono',monospace;text-transform:uppercase;letter-spacing:2px;color:var(--muted);margin-bottom:10px}
        .stat-value{font-family:'Playfair Display',serif;font-size:32px;font-weight:900;color:var(--bright);line-height:1;margin-bottom:6px}
        .stat-sub{font-size:10px;color:var(--muted);font-family:'DM Mono',monospace}
        .stat-sub.up{color:#4ade80}

        /* GRID */
        .main-grid{display:grid;grid-template-columns:1fr 320px;gap:20px}
        .left-col{display:flex;flex-direction:column;gap:20px}
        .right-col{display:flex;flex-direction:column;gap:20px}

        /* CARDS */
        .card{background:var(--ink-2);border:1px solid var(--rule);border-radius:4px;overflow:hidden}
        .card-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--rule)}
        .card-title{font-family:'Playfair Display',serif;font-size:14px;font-weight:700;color:var(--bright)}
        .card-action{font-size:10px;font-family:'DM Mono',monospace;color:var(--gold);text-decoration:none;background:var(--gold-glow);padding:4px 10px;border-radius:2px;transition:all .15s}
        .card-action:hover{background:rgba(212,168,67,.2)}

        /* EVAL */
        .eval-hero{margin:20px;background:var(--ink-3);border:1px solid var(--rule);border-radius:3px;padding:20px;position:relative;overflow:hidden}
        .eval-hero::after{content:'';position:absolute;right:-30px;bottom:-30px;width:120px;height:120px;border:1px solid var(--gold-glow);border-radius:50%}
        .eval-status-pill{display:inline-flex;align-items:center;gap:6px;font-family:'DM Mono',monospace;font-size:9px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:12px}
        .pulse-dot{width:6px;height:6px;background:var(--gold);border-radius:50%;animation:pulse-gold 1.5s ease-in-out infinite}
        @keyframes pulse-gold{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.3)}}
        .eval-title{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;color:var(--bright);margin-bottom:6px}
        .eval-desc{font-size:11px;color:var(--muted);line-height:1.6;margin-bottom:16px}
        .progress-row{display:flex;justify-content:space-between;font-size:10px;font-family:'DM Mono',monospace;color:var(--dim);margin-bottom:6px}
        .progress-count{color:var(--bright);font-weight:500}
        .progress-track{height:3px;background:var(--rule-2);border-radius:2px;overflow:hidden}
        .progress-fill{height:100%;background:linear-gradient(90deg,var(--gold-dim),var(--gold));border-radius:2px;transition:width 1s cubic-bezier(.16,1,.3,1)}

        /* RATINGS */
        .ratings-section{padding:20px;border-top:1px solid var(--rule)}
        .ratings-label{font-size:9px;font-family:'DM Mono',monospace;text-transform:uppercase;letter-spacing:2px;color:var(--muted);margin-bottom:14px}
        .rating-row{display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .rating-name{font-size:11px;color:var(--dim);width:130px;flex-shrink:0}
        .rating-track{flex:1;height:2px;background:var(--rule-2);border-radius:1px;overflow:hidden}
        .rating-fill{height:100%;background:var(--gold);border-radius:1px;width:0;transition:width .9s cubic-bezier(.16,1,.3,1)}
        .rating-score{font-family:'DM Mono',monospace;font-size:10px;color:var(--bright);width:28px;text-align:right;flex-shrink:0}

        /* ACTIVITY */
        .activity-item{display:flex;align-items:flex-start;gap:12px;padding:14px 20px;border-bottom:1px solid var(--rule);transition:background .12s}
        .activity-item:last-child{border-bottom:none}
        .activity-item:hover{background:var(--ink-3)}
        .activity-icon{width:30px;height:30px;border-radius:3px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .activity-icon svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:1.8}
        .activity-icon.gold{background:var(--gold-glow);color:var(--gold)}
        .activity-icon.jade{background:var(--jade-dim);color:#4ade80}
        .activity-icon.blue{background:rgba(96,165,250,.1);color:#60a5fa}
        .activity-icon.gray{background:var(--ink-3);color:var(--dim)}
        .activity-body{flex:1;min-width:0}
        .activity-title{font-size:12px;font-weight:600;color:var(--bright);margin-bottom:2px}
        .activity-desc{font-size:11px;color:var(--muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .activity-time{font-size:9px;font-family:'DM Mono',monospace;color:var(--rule-2);flex-shrink:0;margin-top:2px}

        /* QUICK ACTIONS */
        .quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--rule)}
        .quick-btn{background:var(--ink-2);padding:16px;display:flex;flex-direction:column;align-items:flex-start;gap:8px;text-decoration:none;transition:background .15s;cursor:pointer;border:none}
        .quick-btn:hover{background:var(--ink-3)}
        .quick-icon{width:28px;height:28px;border-radius:3px;background:var(--ink-3);border:1px solid var(--rule);display:flex;align-items:center;justify-content:center;color:var(--gold)}
        .quick-icon svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:1.8}
        .quick-label{font-size:11px;font-weight:600;color:var(--dim)}

        /* PROFILE */
        .profile-banner{height:56px;background:var(--ink-3);position:relative;overflow:hidden}
        .profile-banner-pattern{position:absolute;inset:0;background-image:repeating-linear-gradient(-45deg,transparent,transparent 12px,rgba(212,168,67,.04) 12px,rgba(212,168,67,.04) 13px)}
        .profile-content{padding:0 18px 18px}
        .profile-avatar-wrap{margin-top:-20px;margin-bottom:12px;position:relative;z-index:1}
        .profile-avatar{width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,var(--gold),var(--ember));display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#000;border:2px solid var(--ink-2);font-family:'DM Mono',monospace;overflow:hidden}
        .profile-avatar img{width:100%;height:100%;object-fit:cover}
        .profile-name{font-family:'Playfair Display',serif;font-size:15px;font-weight:700;color:var(--bright);margin-bottom:2px}
        .profile-role{font-size:11px;color:var(--muted);margin-bottom:14px}
        .profile-detail{display:flex;align-items:center;gap:8px;font-size:11px;color:var(--muted);margin-bottom:7px;font-family:'DM Mono',monospace}
        .profile-detail svg{width:11px;height:11px;stroke:var(--rule-2);fill:none;stroke-width:1.8;flex-shrink:0}
        .profile-divider{border:none;border-top:1px solid var(--rule);margin:14px 0}
        .role-badge{display:inline-block;font-size:9px;font-family:'DM Mono',monospace;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;padding:4px 10px;border-radius:2px;border:1px solid}
        .role-badge.super{background:var(--gold-glow);color:var(--gold);border-color:var(--gold-dim)}
        .role-badge.manager{background:rgba(96,165,250,.08);color:#60a5fa;border-color:rgba(96,165,250,.2)}
        .role-badge.staff{background:var(--ink-3);color:var(--dim);border-color:var(--rule-2)}

        /* ANNOUNCEMENTS */
        .announce-item{padding:14px 18px;border-bottom:1px solid var(--rule)}
        .announce-item:last-child{border-bottom:none}
        .announce-tag{font-size:8px;font-family:'DM Mono',monospace;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:5px}
        .announce-tag.urgent{color:var(--gold)}
        .announce-tag.pay{color:var(--ember)}
        .announce-tag.team{color:#4ade80}
        .announce-title{font-size:12px;font-weight:600;color:var(--bright);margin-bottom:4px}
        .announce-body{font-size:11px;color:var(--muted);line-height:1.5}

        /* ACTION CARD */
        .action-card{background:linear-gradient(135deg,var(--ink-3) 0%,var(--ink-4) 100%);border:1px solid var(--rule);border-radius:4px;padding:20px;position:relative;overflow:hidden}
        .action-card::before{content:'';position:absolute;top:-40px;right:-40px;width:140px;height:140px;border:1px solid rgba(212,168,67,.08);border-radius:50%}
        .action-card::after{content:'';position:absolute;top:-10px;right:-10px;width:80px;height:80px;border:1px solid rgba(212,168,67,.05);border-radius:50%}
        .action-eyebrow{font-size:8px;font-family:'DM Mono',monospace;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--gold);margin-bottom:8px}
        .action-title{font-family:'Playfair Display',serif;font-size:14px;font-weight:700;color:var(--bright);margin-bottom:8px;line-height:1.3}
        .action-body{font-size:11px;color:var(--muted);line-height:1.6;margin-bottom:16px}
        .action-btn{display:inline-flex;align-items:center;gap:6px;background:var(--gold);color:#000;font-size:10px;font-weight:700;padding:8px 16px;border-radius:2px;text-decoration:none;letter-spacing:.3px;transition:all .2s;font-family:'DM Sans',sans-serif}
        .action-btn:hover{background:#e6ba55;transform:translateY(-1px);box-shadow:0 4px 16px rgba(212,168,67,.3)}

        /* ANIMATIONS */
        .fade-up{opacity:0;transform:translateY(12px);animation:fadeUp .5s ease forwards}
        @keyframes fadeUp{to{opacity:1;transform:translateY(0)}}
        .fade-up:nth-child(1){animation-delay:.05s}
        .fade-up:nth-child(2){animation-delay:.1s}
        .fade-up:nth-child(3){animation-delay:.15s}
        .fade-up:nth-child(4){animation-delay:.2s}
        .fade-up:nth-child(5){animation-delay:.25s}
        .fade-up:nth-child(6){animation-delay:.3s}
        .fade-up:nth-child(7){animation-delay:.35s}

        /* RESPONSIVE */
        @media(max-width:1200px){.main-grid{grid-template-columns:1fr}.right-col{display:grid;grid-template-columns:1fr 1fr;gap:20px}}
        @media(max-width:900px){.stats-strip{grid-template-columns:1fr 1fr}.sidebar{width:64px}.sidebar-user,.brand-wordmark,.nav-item span:not(.nav-icon),.nav-badge,.nav-section-label,.logout-btn span{display:none}.nav-item{justify-content:center;padding:10px}.sidebar-brand{justify-content:center}.logout-btn{justify-content:center}.right-col{grid-template-columns:1fr}}
        @media(max-width:640px){.content{padding:16px}.page-header{flex-direction:column}.stats-strip{grid-template-columns:1fr 1fr}}
    </style>
</head>
<body>
@include('layouts.staff-aside')

@yield('content')


<script>
const h = new Date().getHours();
document.getElementById('greeting-label').textContent =
    h < 12 ? 'Good morning' : h < 17 ? 'Good afternoon' : 'Good evening';
document.getElementById('top-date').textContent =
    new Date().toLocaleDateString('en-GB', {weekday:'short',day:'numeric',month:'short',year:'numeric'});
window.addEventListener('load', () => {
    setTimeout(() => { document.getElementById('eval-progress').style.width = '43%'; }, 400);
    document.querySelectorAll('.rating-fill').forEach((el, i) => {
        setTimeout(() => { el.style.width = el.dataset.width; }, 500 + i * 80);
    });
});
</script>
</body>
</html>