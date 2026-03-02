<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body { font-family: Arial, sans-serif; background: #f7f4ef; margin: 0; padding: 0; color: #0f0f0f; }
    .wrapper { max-width: 680px; margin: 30px auto; }
    .header { background: #0f0f0f; padding: 36px 40px 30px; border-radius: 4px 4px 0 0; }
    .header .tag { display: inline-block; background: #c8420a; color: white; font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 5px 12px; border-radius: 2px; margin-bottom: 16px; }
    .header h1 { font-size: 22px; color: white; margin: 0 0 6px; }
    .header p { font-size: 12px; color: rgba(255,255,255,0.55); margin: 0; }
    .body { background: white; padding: 36px 40px; border: 1px solid #ddd8d0; border-top: none; border-radius: 0 0 4px 4px; }
    .section { margin-bottom: 28px; }
    .section-title { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #c8420a; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1px solid #ddd8d0; }
    .row { display: flex; margin-bottom: 8px; }
    .row .lbl { font-size: 12px; font-weight: 700; color: #7a7065; min-width: 190px; flex-shrink: 0; }
    .row .val { font-size: 13px; color: #0f0f0f; }
    .rating-badge { display: inline-block; background: #0f0f0f; color: white; font-size: 12px; font-weight: 700; padding: 2px 10px; border-radius: 2px; }
    .long-text { font-size: 13px; color: #0f0f0f; line-height: 1.6; background: #f7f4ef; padding: 12px 14px; border-radius: 3px; margin-top: 4px; }
    .tag-list { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 4px; }
    .tag-item { background: #f7f4ef; border: 1px solid #ddd8d0; font-size: 11px; padding: 3px 10px; border-radius: 2px; }
    .avg-score { background: #c8420a; color: white; text-align: center; padding: 14px; border-radius: 3px; margin-bottom: 20px; }
    .avg-score .num { font-size: 32px; font-weight: 700; display: block; }
    .avg-score .sub { font-size: 11px; opacity: 0.8; }
    .footer { text-align: center; margin-top: 20px; font-size: 11px; color: #7a7065; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="tag">◆ HR Notification</div>
        <h1>New Evaluation: {{ $evaluation->full_name }}</h1>
        <p>Submitted {{ now()->format('F j, Y \a\t g:i A') }} — Confidential</p>
    </div>
    <div class="body">

        {{-- Average Score --}}
        @if($evaluation->average_rating)
        <div class="avg-score">
            <span class="num">{{ $evaluation->average_rating }}/5</span>
            <span class="sub">Average Self-Performance Score</span>
        </div>
        @endif

        {{-- Section 1 --}}
        <div class="section">
            <div class="section-title">01 — Personal Information</div>
            <div class="row"><span class="lbl">Full Name</span><span class="val">{{ $evaluation->full_name }}</span></div>
            <div class="row"><span class="lbl">Email</span><span class="val">{{ $evaluation->email }}</span></div>
            <div class="row"><span class="lbl">Phone</span><span class="val">{{ $evaluation->phone ?? '—' }}</span></div>
            <div class="row"><span class="lbl">Department</span><span class="val">{{ $evaluation->department }}</span></div>
            <div class="row"><span class="lbl">Tenure</span><span class="val">{{ $evaluation->tenure }}</span></div>
        </div>

        {{-- Section 2 --}}
        <div class="section">
            <div class="section-title">02 — Self-Performance Ratings</div>
            @php
            $ratingLabels = [
                'rating_quality'             => 'Quality of Work',
                'rating_timeliness'          => 'Timeliness',
                'rating_communication'       => 'Communication',
                'rating_initiative'          => 'Initiative',
                'rating_tools_knowledge'     => 'Tools Knowledge',
                'rating_attitude'            => 'Attitude',
                'rating_client_satisfaction' => 'Client Satisfaction',
            ];
            @endphp
            @foreach($ratingLabels as $field => $label)
            <div class="row">
                <span class="lbl">{{ $label }}</span>
                <span class="val">
                    @if($evaluation->$field)
                        <span class="rating-badge">{{ $evaluation->$field }}/5</span>
                        {{ str_repeat('★', $evaluation->$field) }}{{ str_repeat('☆', 5 - $evaluation->$field) }}
                    @else —
                    @endif
                </span>
            </div>
            @endforeach
        </div>

        {{-- Section 3 --}}
        <div class="section">
            <div class="section-title">03 — Workflow & Operational Understanding</div>
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin-bottom:4px;">Daily Responsibilities</p>
            <div class="long-text">{{ $evaluation->daily_responsibilities }}</div>

            @if($evaluation->workflow_process)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Order Workflow</p>
            <div class="long-text">{{ $evaluation->workflow_process }}</div>
            @endif

            @if($evaluation->task_tracking_methods)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Task Tracking Methods</p>
            <div class="tag-list">
                @foreach($evaluation->task_tracking_methods as $m)
                    <span class="tag-item">{{ $m }}</span>
                @endforeach
            </div>
            @endif

            @if($evaluation->deadline_miss_frequency)
            <div class="row" style="margin-top:14px;"><span class="lbl">Deadline Issues</span><span class="val">{{ $evaluation->deadline_miss_frequency }}</span></div>
            @endif
        </div>

        {{-- Section 4 --}}
        <div class="section">
            <div class="section-title">04 — Accountability</div>
            <div class="row"><span class="lbl">Underperformance Reason</span><span class="val">{{ $evaluation->underperformance_reason ?? '—' }}</span></div>
            <div class="row"><span class="lbl">Made Error</span><span class="val">{{ $evaluation->made_error ?? '—' }}</span></div>
            @if($evaluation->error_description)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:10px 0 4px;">Error Description</p>
            <div class="long-text">{{ $evaluation->error_description }}</div>
            @endif
            @if($evaluation->team_issues)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Team Issues</p>
            <div class="long-text">{{ $evaluation->team_issues }}</div>
            @endif
        </div>

        {{-- Section 5 --}}
        <div class="section">
            <div class="section-title">05 — Growth & Commitment</div>
            <div class="row"><span class="lbl">Commitment Level</span><span class="val">
                @if($evaluation->commitment_level)
                    <span class="rating-badge">{{ $evaluation->commitment_level }}/5</span>
                @else —
                @endif
            </span></div>
            <div class="row"><span class="lbl">Future Plans</span><span class="val">{{ $evaluation->future_plans ?? '—' }}</span></div>
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:10px 0 4px;">Skills Growth</p>
            <div class="long-text">{{ $evaluation->skills_growth }}</div>
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Motivation Factors</p>
            <div class="long-text">{{ $evaluation->motivation_factors }}</div>
        </div>

        {{-- Section 6 --}}
        <div class="section">
            <div class="section-title">06 — Operational Feedback</div>
            <div class="row"><span class="lbl">Priority Improvement Area</span><span class="val">{{ $evaluation->improvement_area ?? '—' }}</span></div>
            @if($evaluation->one_change)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:10px 0 4px;">One Immediate Change</p>
            <div class="long-text">{{ $evaluation->one_change }}</div>
            @endif
            @if($evaluation->open_feedback)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Open Feedback</p>
            <div class="long-text">{{ $evaluation->open_feedback }}</div>
            @endif
        </div>

        {{-- Section 7 --}}
        <div class="section">
            <div class="section-title">07 — Compensation & Financial Wellbeing</div>
            <div class="row"><span class="lbl">Current Monthly Salary</span><span class="val">{{ $evaluation->current_salary ? '₦' . $evaluation->current_salary : '—' }}</span></div>
            <div class="row"><span class="lbl">Salary Satisfaction</span><span class="val">{{ $evaluation->salary_satisfaction ?? '—' }}</span></div>
            <div class="row"><span class="lbl">Salary Impact on Work</span><span class="val">{{ $evaluation->salary_impact ?? '—' }}</span></div>
            <div class="row"><span class="lbl">Expected Fair Salary</span><span class="val">{{ $evaluation->expected_salary ? '₦' . $evaluation->expected_salary : '—' }}</span></div>

            @if($evaluation->financial_pressures)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:10px 0 4px;">Financial Pressures</p>
            <div class="tag-list">
                @foreach($evaluation->financial_pressures as $fp)
                    <span class="tag-item">{{ $fp }}</span>
                @endforeach
            </div>
            @endif

            @if($evaluation->desired_benefits)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Desired Benefits</p>
            <div class="tag-list">
                @foreach($evaluation->desired_benefits as $b)
                    <span class="tag-item">{{ $b }}</span>
                @endforeach
            </div>
            @endif

            @if($evaluation->salary_justification)
            <p style="font-size:12px;font-weight:700;color:#7a7065;margin:14px 0 4px;">Salary Justification</p>
            <div class="long-text">{{ $evaluation->salary_justification }}</div>
            @endif
        </div>

    </div>
    <div class="footer">
        Submitted from IP: {{ $evaluation->ip_address }} — Printbuka Internal Review System<br>
        This email is strictly confidential and intended for HR use only.
    </div>
</div>
</body>
</html>
