<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Printbuka — Staff Performance Evaluation</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', 'sans-serif'],
                serif: ['Playfair Display', 'serif'],
            },
            colors: {
                ink: '#0f0f0f',
                paper: '#f7f4ef',
                accent: '#c80a7f',
                muted: '#7a7065',
                border: '#ddd8d0',
                card: '#ffffff',
                gold: '#d19406',
            },
        },
    },
}
</script>
<style>
    body { background-color: #f7f4ef; }
    input[type="text"], input[type="email"], select, textarea {
        background-color: #f7f4ef;
        transition: border-color 0.2s, box-shadow 0.2s;
        appearance: none;
        -webkit-appearance: none;
    }
    input:focus, select:focus, textarea:focus {
        background-color: #ffffff;
        border-color: #c80a7f !important;
        box-shadow: 0 0 0 3px rgba(200,66,10,0.08);
        outline: none;
    }
    .rating-scale input[type="radio"] { display: none; }
    .rating-scale input[type="radio"]:checked + label {
        background-color: #c80a7f;
        border-color: #c80a7f;
        color: white;
    }
    .option-item:has(input:checked) {
        border-color: #c80a7f;
        background-color: rgba(200,66,10,0.04);
    }
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' fill='none' stroke='%230f0f0f' stroke-width='1.5'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
        cursor: pointer;
    }
    .hero-circle-1 {
        position: absolute; top: -40px; right: -60px;
        width: 320px; height: 320px;
        border: 2px solid rgba(200,66,10,0.3); border-radius: 50%;
    }
    .hero-circle-2 {
        position: absolute; bottom: -80px; left: 40px;
        width: 200px; height: 200px;
        border: 1px solid rgba(212,168,67,0.2); border-radius: 50%;
    }
    .submit-btn:hover { background-color: #c80a7f !important; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(200,66,10,0.25); }
    .submit-btn { transition: all 0.2s; }
</style>
</head>
<body class="font-sans text-ink min-h-screen">

{{-- HERO HEADER --}}
<div class="bg-ink text-white px-10 py-16 relative overflow-hidden">
    <div class="hero-circle-1"></div>
    <div class="hero-circle-2"></div>
    <div class="max-w-3xl mx-auto relative z-10">
        <div class="inline-flex items-center gap-2 bg-accent text-white text-xs font-semibold tracking-widest uppercase px-3.5 py-1.5 rounded-sm mb-6">
            <span class="text-[8px]">◆</span> Printbuka
        </div>
        <h1 class="font-serif text-4xl md:text-5xl font-bold leading-tight mb-4">
            Staff Performance<br><span class="text-gold">Evaluation Results</span>
        </h1>
        <p class="text-sm text-white/60 leading-relaxed max-w-lg font-light">
            This displays the entries submitted by staff members for the Q1 2026 performance evaluation. All responses are strictly confidential and will be used solely for internal review and development purposes.
        </p>
        <div class="mt-8 flex gap-8 flex-wrap">
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Period</span>
                <span class="text-sm text-white/85 font-medium">Q1 2026 — Internal Review</span>
            </div>
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Confidentiality</span>
                <span class="text-sm text-white/85 font-medium">Strictly Confidential</span>
            </div>
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Est. Time</span>
                <span class="text-sm text-white/85 font-medium">10 – 15 minutes</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-6 py-10 pb-20">
    <h2 class="text-xl font-bold mb-6">Submitted Evaluations</h2>
    @if($evaluations->count() > 0)
        <div class="space-y-4">
            @foreach($evaluations as $evaluation)
                <a href="{{ route('evaluation.showDetail', $evaluation->id) }}" class="bg-card border border-border rounded-lg p-4 shadow-sm block hover:bg-muted/5 transition-colors">
                    <h3 class="font-semibold text-lg">{{ $evaluation->full_name }}</h3>
                    <p class="text-sm text-muted">{{ $evaluation->email }}</p>
                    <p class="text-sm text-muted">{{ $evaluation->department }}</p>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-muted">No evaluations have been submitted yet.</p>
    @endif
</div>


</body>
</html>
