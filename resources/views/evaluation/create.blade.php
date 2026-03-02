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
            Staff Performance<br><span class="text-gold">Evaluation Form</span>
        </h1>
        <p class="text-sm text-white/60 leading-relaxed max-w-lg font-light">
            This evaluation is designed to give every team member a fair and structured opportunity to demonstrate their competencies, identify gaps, and contribute to a stronger Printbuka.
        </p>
        <div class="mt-8 flex gap-8 flex-wrap">
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Period</span>
                <span class="text-sm text-white/85 font-medium">2025 — Internal Review</span>
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

    {{-- Global Error Summary --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded p-4">
            <p class="text-sm font-semibold text-red-700 mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('evaluation.store') }}" method="POST">
        @csrf

        {{-- ===== SECTION 1: PERSONAL INFORMATION ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 01</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Personal Information</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">Basic details about the employee completing this form. All responses are confidential and used for internal restructuring purposes only.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-2">Full Name <span class="text-accent">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}"
                    placeholder="Enter your full name"
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink @error('full_name') border-red-400 @enderror">
                @error('full_name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-xs font-semibold mb-2">Email Address <span class="text-accent">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="you@printbuka.com"
                        class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink @error('email') border-red-400 @enderror">
                    @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        placeholder="+234 000 0000 000"
                        class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-2">Department / Role <span class="text-accent">*</span></label>
                    <select name="department" class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink @error('department') border-red-400 @enderror">
                        <option value="">— Select your role —</option>
                        @foreach(['Design & Creative','Production / Print Operations','Sales & Client Relations','Accounting & Finance','Customer Service','Logistics & Delivery','IT & Digital Operations','Management','Other'] as $dept)
                            <option value="{{ $dept }}" {{ old('department') == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                    @error('department')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-2">Duration at Printbuka <span class="text-accent">*</span></label>
                    <select name="tenure" class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink @error('tenure') border-red-400 @enderror">
                        <option value="">— Select duration —</option>
                        @foreach(['Less than 3 months','3 – 6 months','6 months – 1 year','1 – 2 years','2 – 3 years','Over 3 years'] as $t)
                            <option value="{{ $t }}" {{ old('tenure') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('tenure')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- ===== SECTION 2: SELF-PERFORMANCE RATING ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 02</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Self-Performance Rating</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">Rate yourself honestly on each area from 1 (Very Poor) to 5 (Excellent). Honest responses lead to better support and outcomes for everyone.</p>

            @php
            $ratings = [
                ['name' => 'rating_quality',             'label' => 'Quality of Work Output',           'sub' => 'How well do you deliver accurate, high-quality results?'],
                ['name' => 'rating_timeliness',          'label' => 'Timeliness & Deadline Adherence',   'sub' => 'Do you consistently meet deadlines?'],
                ['name' => 'rating_communication',       'label' => 'Communication & Collaboration',     'sub' => 'How well do you communicate with teammates and clients?'],
                ['name' => 'rating_initiative',          'label' => 'Initiative & Problem Solving',      'sub' => 'Do you proactively identify and fix issues without being told?'],
                ['name' => 'rating_tools_knowledge',     'label' => 'Knowledge of Tools & Software',     'sub' => 'Proficiency with tools relevant to your role (design apps, accounting software, etc.)'],
                ['name' => 'rating_attitude',            'label' => 'Attitude & Professionalism',        'sub' => 'How would you describe your conduct at work?'],
                ['name' => 'rating_client_satisfaction', 'label' => 'Client/Customer Satisfaction',     'sub' => 'How often do clients leave happy because of your work?'],
            ];
            @endphp

            @foreach($ratings as $r)
            <div class="mb-6 last:mb-0">
                <p class="text-xs font-semibold mb-2.5">{{ $r['label'] }} <span class="font-normal text-muted text-xs">— {{ $r['sub'] }}</span></p>
                <div class="rating-scale flex gap-2 flex-wrap">
                    @for($i = 1; $i <= 5; $i++)
                        <input type="radio" name="{{ $r['name'] }}" id="{{ $r['name'] }}-{{ $i }}" value="{{ $i }}"
                            {{ old($r['name']) == $i ? 'checked' : '' }}>
                        <label for="{{ $r['name'] }}-{{ $i }}"
                            class="flex items-center justify-center w-11 h-11 border-[1.5px] border-border rounded-sm cursor-pointer text-sm font-semibold text-muted hover:border-accent hover:text-accent hover:bg-accent/5 transition-all">
                            {{ $i }}
                        </label>
                    @endfor
                </div>
                <div class="flex justify-between text-[11px] text-muted mt-1.5 px-0.5">
                    <span>Very Poor</span><span>Excellent</span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ===== SECTION 3: WORKFLOW ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 03</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Workflow & Operational Understanding</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">This helps us understand how well staff understand their role within Printbuka's broader operations.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">Describe your daily responsibilities in your own words <span class="text-accent">*</span></label>
                <span class="block text-xs text-muted mb-2">Be specific — what do you actually do day to day?</span>
                <textarea name="daily_responsibilities" rows="4"
                    placeholder="e.g. I receive client briefs, prepare design proofs, communicate revisions, and liaise with the production team for printing..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed @error('daily_responsibilities') border-red-400 @enderror">{{ old('daily_responsibilities') }}</textarea>
                @error('daily_responsibilities')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">What is your current workflow for handling a client order from start to finish?</label>
                <span class="block text-xs text-muted mb-2">Walk us through your process step by step.</span>
                <textarea name="workflow_process" rows="4"
                    placeholder="Step 1: Client places order via... Step 2: I..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('workflow_process') }}</textarea>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-3">How do you track the tasks or orders you're responsible for?</label>
                <div class="flex flex-col gap-2.5">
                    @php
                    $trackingOptions = [
                        'spreadsheet' => 'Spreadsheets (Excel / Google Sheets)',
                        'trello'      => 'Project management tool (Trello, Asana, Notion, etc.)',
                        'whatsapp'    => 'WhatsApp / messaging threads',
                        'mental'      => 'Mostly in my head',
                        'none'        => 'I don\'t have a specific system',
                    ];
                    $oldTracking = old('task_tracking_methods', []);
                    @endphp
                    @foreach($trackingOptions as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="checkbox" name="task_tracking_methods[]" value="{{ $val }}"
                            {{ in_array($val, $oldTracking) ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-2">How often do you miss deadlines or delay a client's order?</label>
                <select name="deadline_miss_frequency" class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink">
                    <option value="">— Select honestly —</option>
                    @foreach(['Never — I always deliver on time','Rarely — occasionally due to external factors','Sometimes — I struggle but try my best','Often — this is a recurring challenge for me','Very often — I need significant support here'] as $opt)
                        <option value="{{ $opt }}" {{ old('deadline_miss_frequency') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ===== SECTION 4: ACCOUNTABILITY ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 04</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Accountability & Transparency</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">Your honest answers here are critical. This is your opportunity to speak up — without judgment.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-3">What do you think is the biggest reason for underperformance at Printbuka currently? <span class="text-accent">*</span></label>
                <div class="flex flex-col gap-2.5">
                    @php
                    $underperformReasons = [
                        'unclear-roles' => 'Roles and responsibilities are not clearly defined',
                        'no-process'    => 'There are no standard processes or workflows to follow',
                        'tools'         => 'Lack of proper tools, software, or equipment',
                        'management'    => 'Poor leadership or communication from management',
                        'team'          => 'Low motivation or attitude issues within the team',
                        'overload'      => 'Too much workload for the available staff',
                        'personal'      => 'Personal skill gaps among some staff members',
                    ];
                    @endphp
                    @foreach($underperformReasons as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="radio" name="underperformance_reason" value="{{ $val }}"
                            {{ old('underperformance_reason') == $val ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-2">Have you ever made an error that negatively affected a client or the business? <span class="text-accent">*</span></label>
                <select name="made_error" class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink @error('made_error') border-red-400 @enderror">
                    <option value="">— Select —</option>
                    @foreach(['Yes, and I reported it and helped resolve it','Yes, but I tried to fix it quietly without reporting','Yes, and I was unaware how to handle it','No, not that I\'m aware of'] as $opt)
                        <option value="{{ $opt }}" {{ old('made_error') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">If yes, briefly describe what happened and what you did about it</label>
                <span class="block text-xs text-muted mb-2">Optional but strongly encouraged. This is confidential.</span>
                <textarea name="error_description" rows="3"
                    placeholder="Describe the situation, your role in it, and what you did afterwards..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('error_description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1">Are there any team members whose behaviour or attitude affects the work environment negatively?</label>
                <span class="block text-xs text-muted mb-2">You don't need to name anyone — describe the behaviour pattern.</span>
                <textarea name="team_issues" rows="3"
                    placeholder="e.g. Some team members frequently arrive late which causes delays in production..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('team_issues') }}</textarea>
            </div>
        </div>

        {{-- ===== SECTION 5: GROWTH & COMMITMENT ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 05</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Growth, Commitment & Future</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">We want to understand who is invested in growing with Printbuka and who has the potential to lead.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-2">What skills are you currently developing or would like to develop? <span class="text-accent">*</span></label>
                <textarea name="skills_growth" rows="3"
                    placeholder="e.g. I'm learning advanced graphic design, I want to improve my customer handling skills..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed @error('skills_growth') border-red-400 @enderror">{{ old('skills_growth') }}</textarea>
                @error('skills_growth')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <p class="text-xs font-semibold mb-2.5">On a scale of 1–5, how committed are you to staying and growing with Printbuka?</p>
                <div class="rating-scale flex gap-2 flex-wrap">
                    @for($i = 1; $i <= 5; $i++)
                        <input type="radio" name="commitment_level" id="c{{ $i }}" value="{{ $i }}"
                            {{ old('commitment_level') == $i ? 'checked' : '' }}>
                        <label for="c{{ $i }}"
                            class="flex items-center justify-center w-11 h-11 border-[1.5px] border-border rounded-sm cursor-pointer text-sm font-semibold text-muted hover:border-accent hover:text-accent hover:bg-accent/5 transition-all">
                            {{ $i }}
                        </label>
                    @endfor
                </div>
                <div class="flex justify-between text-[11px] text-muted mt-1.5 max-w-[260px]">
                    <span>Not committed</span><span>Fully committed</span>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-3">Where do you see yourself within Printbuka in the next 12 months?</label>
                <div class="flex flex-col gap-2.5">
                    @php
                    $futureOptions = [
                        'same-role' => 'Still in the same role, doing it better',
                        'promotion' => 'In a senior or leadership role',
                        'new-dept'  => 'In a different department that suits me better',
                        'uncertain' => 'I\'m unsure — it depends on how things evolve',
                        'leaving'   => 'I may have moved on to another opportunity',
                    ];
                    @endphp
                    @foreach($futureOptions as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="radio" name="future_plans" value="{{ $val }}"
                            {{ old('future_plans') == $val ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-2">What would make you significantly more productive and motivated at Printbuka? <span class="text-accent">*</span></label>
                <textarea name="motivation_factors" rows="3"
                    placeholder="Be specific — what do you actually need? Better tools, training, clearer instructions, better pay, better team structure..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed @error('motivation_factors') border-red-400 @enderror">{{ old('motivation_factors') }}</textarea>
                @error('motivation_factors')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- ===== SECTION 6: OPERATIONAL FEEDBACK ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 06</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Operational Feedback</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">Your perspective on what needs to change at Printbuka — operationally and structurally.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-2">Which area of Printbuka's operations do you think needs the most urgent improvement?</label>
                <select name="improvement_area" class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink">
                    <option value="">— Select one —</option>
                    @foreach(['Order intake and client onboarding','Production turnaround time','Design review and approval process','Pricing and invoicing','Client communication and follow-up','Internal team communication','Accounting and financial tracking','Delivery and logistics','Staff training and development','Technology and tools'] as $opt)
                        <option value="{{ $opt }}" {{ old('improvement_area') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-2">If you were in charge for one week, what one change would you make immediately?</label>
                <textarea name="one_change" rows="3"
                    placeholder="This is your chance to be constructive. What specific change would make the biggest difference?"
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('one_change') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-2">Any other feedback, concerns, or suggestions you'd like to share with management?</label>
                <textarea name="open_feedback" rows="3"
                    placeholder="This is a safe space. Say what needs to be said."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('open_feedback') }}</textarea>
            </div>
        </div>

        {{-- ===== SECTION 7: COMPENSATION ===== --}}
        <div class="bg-card border border-border rounded p-9 mb-5 relative">
            <div class="absolute -top-3 left-7 bg-accent text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-sm">Section 07</div>

            <h2 class="font-serif text-xl font-bold mb-1.5">Compensation & Financial Wellbeing</h2>
            <p class="text-xs text-muted mb-7 leading-relaxed">This section is strictly confidential. We want to understand how compensation affects your performance and morale. Honest answers help us build a fairer pay structure at Printbuka.</p>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">What is your current monthly salary? <span class="text-accent">*</span></label>
                <span class="block text-xs text-muted mb-2">Enter the exact amount in Naira (₦). This is confidential.</span>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-semibold text-muted text-sm">₦</span>
                    <input type="text" name="current_salary" value="{{ old('current_salary') }}"
                        placeholder="e.g. 80,000"
                        class="w-full pl-8 pr-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink">
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-3">How satisfied are you with your current salary? <span class="text-accent">*</span></label>
                <div class="flex flex-col gap-2.5">
                    @php
                    $salarySatisfactions = [
                        'very-satisfied'   => 'Very satisfied — it fairly reflects my role and effort',
                        'satisfied'        => 'Satisfied — it\'s okay for now, though room for improvement exists',
                        'neutral'          => 'Neutral — I\'ve accepted it but it doesn\'t fully motivate me',
                        'unsatisfied'      => 'Unsatisfied — I feel underpaid relative to my contribution',
                        'very-unsatisfied' => 'Very unsatisfied — it\'s a serious concern affecting my output',
                    ];
                    @endphp
                    @foreach($salarySatisfactions as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="radio" name="salary_satisfaction" value="{{ $val }}"
                            {{ old('salary_satisfaction') == $val ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-3">Does your current salary affect your performance or motivation at work? <span class="text-accent">*</span></label>
                <div class="flex flex-col gap-2.5">
                    @php
                    $salaryImpacts = [
                        'no-impact'          => 'No — I give my best regardless of pay',
                        'slight-impact'      => 'Slightly — it occasionally affects my energy but I manage',
                        'moderate-impact'    => 'Moderately — I find it harder to go above and beyond',
                        'significant-impact' => 'Significantly — it directly limits how much effort I put in',
                        'major-impact'       => 'Majorly — it is one of the primary reasons I am not performing at my best',
                    ];
                    @endphp
                    @foreach($salaryImpacts as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="radio" name="salary_impact" value="{{ $val }}"
                            {{ old('salary_impact') == $val ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">Are there financial pressures outside work that affect your focus or availability?</label>
                <span class="block text-xs text-muted mb-3">Optional. This helps us understand the full picture — not to judge, but to support where possible.</span>
                <div class="flex flex-col gap-2.5">
                    @php
                    $finPressures = [
                        'transport'  => 'Transport costs to and from work are a strain',
                        'housing'    => 'Housing / rent pressure',
                        'family'     => 'Family financial obligations (dependents, school fees, etc.)',
                        'debt'       => 'Personal debt or loan repayments',
                        'side-hustle'=> 'I run a side job to supplement income — it sometimes affects focus',
                        'none'       => 'None — my finances are stable',
                    ];
                    $oldFin = old('financial_pressures', []);
                    @endphp
                    @foreach($finPressures as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="checkbox" name="financial_pressures[]" value="{{ $val }}"
                            {{ in_array($val, $oldFin) ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">If you are not fully satisfied, what monthly salary would you consider fair for your role and output?</label>
                <span class="block text-xs text-muted mb-2">State a realistic figure in Naira. This will be reviewed during the restructuring process — not guaranteed, but considered.</span>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-semibold text-muted text-sm">₦</span>
                    <input type="text" name="expected_salary" value="{{ old('expected_salary') }}"
                        placeholder="e.g. 120,000"
                        class="w-full pl-8 pr-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink">
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-semibold mb-1">In 2–3 sentences, explain why you believe that salary is justified</label>
                <span class="block text-xs text-muted mb-2">What value, skills, or results do you bring that support this figure?</span>
                <textarea name="salary_justification" rows="3"
                    placeholder="e.g. I manage 3 client accounts independently, handle all design revisions, and consistently deliver within 24 hours..."
                    class="w-full px-3.5 py-3 border-[1.5px] border-border rounded-sm text-sm text-ink resize-y leading-relaxed">{{ old('salary_justification') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1">What non-salary benefits would also make a meaningful difference to you?</label>
                <span class="block text-xs text-muted mb-3">Sometimes recognition and structure matter as much as money.</span>
                <div class="flex flex-col gap-2.5">
                    @php
                    $benefits = [
                        'transport-allowance' => 'Transport or fuel allowance',
                        'data-allowance'      => 'Data / internet allowance',
                        'performance-bonus'   => 'Performance-based bonuses',
                        'training'            => 'Paid training or professional development',
                        'flexible-hours'      => 'Flexible working hours',
                        'health'              => 'Health or HMO coverage',
                        'recognition'         => 'Public recognition / employee of the month',
                        'equity'              => 'Profit sharing or equity in the business',
                    ];
                    $oldBenefits = old('desired_benefits', []);
                    @endphp
                    @foreach($benefits as $val => $label)
                    <label class="option-item flex items-start gap-3 cursor-pointer px-3.5 py-2.5 border-[1.5px] border-border rounded-sm transition-all hover:border-accent hover:bg-accent/5">
                        <input type="checkbox" name="desired_benefits[]" value="{{ $val }}"
                            {{ in_array($val, $oldBenefits) ? 'checked' : '' }}
                            class="mt-0.5 flex-shrink-0 w-4 h-4 accent-accent">
                        <span class="text-sm leading-snug">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== DECLARATION ===== --}}
        <div class="bg-[#fafaf8] border border-dashed border-border rounded p-7 mb-6">
            <div class="flex gap-3.5 items-start">
                <input type="checkbox" name="declaration_agreed" id="declaration" value="1"
                    {{ old('declaration_agreed') ? 'checked' : '' }}
                    class="w-4.5 h-4.5 mt-0.5 flex-shrink-0 accent-accent"
                    style="width:18px;height:18px;accent-color:#c8420a;">
                <label for="declaration" class="text-sm leading-relaxed cursor-pointer">
                    I confirm that all information I have provided in this evaluation is <strong>honest, accurate, and my own genuine assessment</strong>. I understand this form is confidential and will be used solely to improve Printbuka's operations and support staff development decisions.
                </label>
            </div>
            @error('declaration_agreed')<p class="text-xs text-red-500 mt-2 ml-7">{{ $message }}</p>@enderror
        </div>

        {{-- ===== SUBMIT ===== --}}
        <div class="text-center py-4">
            <button type="submit"
                class="submit-btn inline-flex items-center gap-2.5 bg-ink text-white px-12 py-4 border-none rounded-sm font-semibold text-sm tracking-wide cursor-pointer">
                Submit Evaluation <span class="text-base">→</span>
            </button>
            <p class="mt-3.5 text-xs text-muted">By submitting, you agree that your responses will be reviewed confidentially by Printbuka's restructuring team.</p>
        </div>

    </form>
</div>

</body>
</html>
