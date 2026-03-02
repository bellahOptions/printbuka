<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Printbuka — {{ $evaluation->full_name }}'s Evaluation Results</title>
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
    .section-card {
        background-color: #ffffff;
        border: 1px solid #ddd8d0;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }
    .section-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .rating-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        background-color: #f7f4ef;
        border: 1px solid #ddd8d0;
        border-radius: 9999px;
        font-weight: 500;
        color: #0f0f0f;
    }
    .rating-badge-high {
        background-color: #c80a7f;
        border-color: #c80a7f;
        color: white;
    }
    .back-btn:hover {
        background-color: #c80a7f !important;
        color: white !important;
        border-color: #c80a7f !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(200,66,10,0.15);
    }
    .back-btn {
        transition: all 0.2s;
    }
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
            {{ $evaluation->full_name }}'s Performance<br><span class="text-gold">Evaluation Results</span>
        </h1>
        <p class="text-sm text-white/60 leading-relaxed max-w-lg font-light">
            Detailed breakdown of the staff evaluation submitted on {{ $evaluation->created_at->format('F j, Y') }}. All responses are strictly confidential and will be used solely for internal review and development purposes.
        </p>
        <div class="mt-8 flex gap-8 flex-wrap">
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Department</span>
                <span class="text-sm text-white/85 font-medium">{{ $evaluation->department }}</span>
            </div>
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Tenure</span>
                <span class="text-sm text-white/85 font-medium">{{ $evaluation->tenure }}</span>
            </div>
            <div class="flex flex-col gap-0.5">
                <span class="text-[10px] tracking-widest uppercase text-white/40">Submitted</span>
                <span class="text-sm text-white/85 font-medium">{{ $evaluation->created_at->format('M j, Y') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-6 py-10 pb-20">
    
    {{-- Back Button --}}
    <a href="{{ route('evaluation.show') }}" class="back-btn inline-flex items-center gap-2 px-5 py-2.5 border border-border bg-card text-sm font-medium rounded-sm mb-8">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
            <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Back to all evaluations
    </a>

    {{-- Personal Information --}}
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Personal Information
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Full Name</p>
                <p class="font-medium">{{ $evaluation->full_name }}</p>
            </div>
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Email Address</p>
                <p class="font-medium">{{ $evaluation->email }}</p>
            </div>
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Phone Number</p>
                <p class="font-medium">{{ $evaluation->phone ?? 'Not provided' }}</p>
            </div>
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Department</p>
                <p class="font-medium">{{ $evaluation->department }}</p>
            </div>
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Tenure</p>
                <p class="font-medium">{{ $evaluation->tenure }}</p>
            </div>
        </div>
    </div>

    {{-- Self-Performance Ratings --}}
    @if($evaluation->rating_quality || $evaluation->rating_timeliness || $evaluation->rating_communication || $evaluation->rating_initiative || $evaluation->rating_tools_knowledge || $evaluation->rating_attitude || $evaluation->rating_client_satisfaction)
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Self-Performance Ratings
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @if($evaluation->rating_quality)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Quality of Work</p>
                <span class="rating-badge {{ $evaluation->rating_quality >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_quality }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_timeliness)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Timeliness</p>
                <span class="rating-badge {{ $evaluation->rating_timeliness >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_timeliness }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_communication)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Communication</p>
                <span class="rating-badge {{ $evaluation->rating_communication >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_communication }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_initiative)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Initiative</p>
                <span class="rating-badge {{ $evaluation->rating_initiative >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_initiative }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_tools_knowledge)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Tools Knowledge</p>
                <span class="rating-badge {{ $evaluation->rating_tools_knowledge >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_tools_knowledge }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_attitude)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Attitude</p>
                <span class="rating-badge {{ $evaluation->rating_attitude >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_attitude }}/5</span>
            </div>
            @endif
            @if($evaluation->rating_client_satisfaction)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-2">Client Satisfaction</p>
                <span class="rating-badge {{ $evaluation->rating_client_satisfaction >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->rating_client_satisfaction }}/5</span>
            </div>
            @endif
        </div>
        @if($evaluation->average_rating)
        <div class="mt-4 pt-4 border-t border-border">
            <p class="text-xs text-muted uppercase tracking-wider mb-1">Average Rating</p>
            <p class="text-2xl font-bold text-accent">{{ $evaluation->average_rating }}/5</p>
        </div>
        @endif
    </div>
    @endif

    {{-- Workflow & Operational Understanding --}}
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Workflow & Operational Understanding
        </h2>
        <div class="space-y-4">
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Daily Responsibilities</p>
                <p class="text-sm">{{ $evaluation->daily_responsibilities }}</p>
            </div>
            @if($evaluation->workflow_process)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Workflow Process</p>
                <p class="text-sm">{{ $evaluation->workflow_process }}</p>
            </div>
            @endif
            @if($evaluation->task_tracking_methods)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Task Tracking Methods</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($evaluation->task_tracking_methods as $method)
                        <span class="px-3 py-1 bg-paper border border-border text-xs rounded-sm">{{ $method }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            @if($evaluation->deadline_miss_frequency)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Deadline Miss Frequency</p>
                <p class="text-sm">{{ $evaluation->deadline_miss_frequency }}</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Accountability --}}
    @if($evaluation->underperformance_reason || $evaluation->made_error || $evaluation->error_description || $evaluation->team_issues)
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Accountability
        </h2>
        <div class="space-y-4">
            @if($evaluation->underperformance_reason)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Underperformance Reason</p>
                <p class="text-sm">{{ $evaluation->underperformance_reason }}</p>
            </div>
            @endif
            @if($evaluation->made_error)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Made Error</p>
                <p class="text-sm">{{ $evaluation->made_error }}</p>
            </div>
            @endif
            @if($evaluation->error_description)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Error Description</p>
                <p class="text-sm">{{ $evaluation->error_description }}</p>
            </div>
            @endif
            @if($evaluation->team_issues)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Team Issues</p>
                <p class="text-sm">{{ $evaluation->team_issues }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Growth & Commitment --}}
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Growth & Commitment
        </h2>
        <div class="space-y-4">
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Skills Growth</p>
                <p class="text-sm">{{ $evaluation->skills_growth }}</p>
            </div>
            @if($evaluation->commitment_level)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Commitment Level</p>
                <span class="rating-badge {{ $evaluation->commitment_level >= 4 ? 'rating-badge-high' : '' }}">{{ $evaluation->commitment_level }}/5</span>
            </div>
            @endif
            @if($evaluation->future_plans)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Future Plans</p>
                <p class="text-sm">{{ $evaluation->future_plans }}</p>
            </div>
            @endif
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Motivation Factors</p>
                <p class="text-sm">{{ $evaluation->motivation_factors }}</p>
            </div>
        </div>
    </div>

    {{-- Operational Feedback --}}
    @if($evaluation->improvement_area || $evaluation->one_change || $evaluation->open_feedback)
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Operational Feedback
        </h2>
        <div class="space-y-4">
            @if($evaluation->improvement_area)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Area for Improvement</p>
                <p class="text-sm">{{ $evaluation->improvement_area }}</p>
            </div>
            @endif
            @if($evaluation->one_change)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">One Change</p>
                <p class="text-sm">{{ $evaluation->one_change }}</p>
            </div>
            @endif
            @if($evaluation->open_feedback)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Open Feedback</p>
                <p class="text-sm">{{ $evaluation->open_feedback }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Compensation --}}
    @if($evaluation->current_salary || $evaluation->salary_satisfaction || $evaluation->salary_impact || $evaluation->financial_pressures || $evaluation->expected_salary || $evaluation->salary_justification || $evaluation->desired_benefits)
    <div class="section-card p-6 mb-6">
        <h2 class="font-serif text-xl font-bold mb-4 flex items-center gap-2">
            <span class="w-1 h-5 bg-accent"></span>
            Compensation
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @if($evaluation->current_salary)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Current Salary</p>
                <p class="font-medium">{{ $evaluation->current_salary }}</p>
            </div>
            @endif
            @if($evaluation->salary_satisfaction)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Salary Satisfaction</p>
                <p class="text-sm">{{ $evaluation->salary_satisfaction }}</p>
            </div>
            @endif
            @if($evaluation->salary_impact)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Salary Impact</p>
                <p class="text-sm">{{ $evaluation->salary_impact }}</p>
            </div>
            @endif
            @if($evaluation->financial_pressures)
            <div class="md:col-span-2">
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Financial Pressures</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($evaluation->financial_pressures as $pressure)
                        <span class="px-3 py-1 bg-paper border border-border text-xs rounded-sm">{{ $pressure }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            @if($evaluation->expected_salary)
            <div>
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Expected Salary</p>
                <p class="font-medium">{{ $evaluation->expected_salary }}</p>
            </div>
            @endif
            @if($evaluation->salary_justification)
            <div class="md:col-span-2">
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Salary Justification</p>
                <p class="text-sm">{{ $evaluation->salary_justification }}</p>
            </div>
            @endif
            @if($evaluation->desired_benefits)
            <div class="md:col-span-2">
                <p class="text-xs text-muted uppercase tracking-wider mb-1">Desired Benefits</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($evaluation->desired_benefits as $benefit)
                        <span class="px-3 py-1 bg-paper border border-border text-xs rounded-sm">{{ $benefit }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Meta Information --}}
    <div class="text-xs text-muted text-right border-t border-border pt-4 mt-4">
        <p>IP Address: {{ $evaluation->ip_address ?? 'Not recorded' }}</p>
        <p>Evaluation ID: #EV-{{ $evaluation->id }}</p>
    </div>
</div>

</body>
</html>