@extends('layouts.staff')
@section('title', 'Job Details')

@section('content')

<div class="pb-layout-3col">
<div class="pb-col-left">


{{-- ALERTS --}}
@if(session('success'))
<div class="pb-alert pb-alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="pb-alert pb-alert-danger">{{ session('error') }}</div>
@endif


{{-- JOB SUMMARY --}}
<div class="pb-card pb-fade-up">
<div class="pb-card-header">
<div>
<div class="pb-card-title">Job #{{ $job->id }}</div>
<div class="pb-card-subtitle">
{{ $job->job_type ?? 'Print Job' }}
</div>
</div>

<span class="pb-nav-badge bg-blue-500">
{{ $job->status }}
</span>

</div>

<div class="pb-card-body">

<div class="grid grid-cols-2 gap-6">

<div>
<strong>Client Name</strong>
<div class="pb-cell-muted">{{ $job->client_name }}</div>
</div>

<div>
<strong>Phone</strong>
<div class="pb-cell-muted">{{ $job->client_phone }}</div>
</div>

<div>
<strong>Email</strong>
<div class="pb-cell-muted">{{ $job->client_email }}</div>
</div>

<div>
<strong>Assigned Designer</strong>
<div class="pb-cell-muted">{{ $job->assigned_designer ?? 'Unassigned' }}</div>
</div>

<div>
<strong>Created</strong>
<div class="pb-cell-muted">
{{ optional($job->created_at)->format('M d, Y') ?? '—' }}
</div>
</div>

<div>
<strong>Due Date</strong>
<div class="pb-cell-muted">
{{ optional($job->due_date)->format('M d, Y') ?? 'Not set' }}
</div>
</div>

</div>

</div>
</div>


{{-- FINANCIALS --}}
@if($canViewFinancials)

<div class="pb-card pb-fade-up">
<div class="pb-card-header">
<div class="pb-card-title">Financial Information</div>
</div>

<div class="pb-card-body">

<div class="grid grid-cols-3 gap-6">

<div>
<strong>Total Cost</strong>
<div class="pb-cell-mono">
₦{{ number_format($job->total_cost,2) }}
</div>
</div>

<div>
<strong>Amount Paid</strong>
<div class="pb-cell-mono">
₦{{ number_format($job->amount_paid,2) }}
</div>
</div>

<div>
<strong>Balance</strong>
<div class="pb-cell-mono">
₦{{ number_format($job->balance,2) }}
</div>
</div>

</div>

</div>
</div>

@endif


{{-- SOP CHECKLIST --}}
<div class="pb-card pb-fade-up">

<div class="pb-card-header">
<div class="pb-card-title">Production SOP Checklist</div>
</div>

<div class="pb-card-body">

@if($job->sopChecklist)

<ul class="space-y-2">

@foreach($job->sopChecklist->items as $item)

<li class="flex items-center gap-3">

<input type="checkbox"
{{ $item['completed'] ? 'checked' : '' }}
disabled>

<span>{{ $item['task'] }}</span>

</li>

@endforeach

</ul>

@else

<div class="pb-cell-muted">
No SOP checklist assigned
</div>

@endif

</div>

</div>



{{-- JOB COMMENTS --}}
<div class="pb-card pb-fade-up">

<div class="pb-card-header">

<div>
<div class="pb-card-title">Production Notes</div>
<div class="pb-card-subtitle">
Phase comments and approvals
</div>
</div>

</div>


<div class="pb-card-body">


{{-- COMMENT FORM --}}
@if($canEdit)

<form id="commentForm">

@csrf

<div class="grid grid-cols-2 gap-4 mb-4">

<select name="phase" class="pb-input">

<option value="General">General</option>
<option value="Intake">Intake</option>
<option value="Design">Design</option>
<option value="Production">Production</option>
<option value="QC">QC</option>
<option value="Delivery">Delivery</option>
<option value="Review">Review</option>

</select>

</div>

<textarea
name="comment"
class="pb-input"
placeholder="Add job comment..."
required
></textarea>

<button type="submit"
class="pb-btn pb-btn-success mt-3">
Add Comment
</button>

</form>

@endif



{{-- COMMENT LIST --}}
<div id="commentsContainer" class="mt-6 space-y-4">

@foreach($job->comments as $comment)

<div class="pb-card">

<div class="pb-card-body">

<div class="flex justify-between">

<div>

<strong>{{ $comment->admin->full_name }}</strong>

<span class="pb-nav-badge bg-gray-600 ml-2">
{{ $comment->phase }}
</span>

<div class="pb-cell-muted text-sm">
{{ $comment->created_at->diffForHumans() }}
</div>

</div>

@if($comment->is_approved_by_manager)

<span class="pb-nav-badge bg-green-500">
Approved
</span>

@endif

</div>


<div class="mt-3">
{{ $comment->comment }}
</div>


{{-- APPROVAL BUTTON --}}
@if(!$comment->is_approved_by_manager && $canApprove)

<button
class="approveComment pb-btn pb-btn-success pb-btn-sm mt-3"
data-id="{{ $comment->id }}"
>
Approve
</button>

@endif


</div>

</div>

@endforeach

</div>


</div>

</div>



</div>
</div>

{{-- AJAX SCRIPT --}}

<script>

const form = document.getElementById('commentForm');

if(form){

form.addEventListener('submit', async function(e){

e.preventDefault();

const data = new FormData(form);

const response = await fetch("",{

method:"POST",
headers:{
'X-CSRF-TOKEN': '{{ csrf_token() }}'
},
body:data

});

const result = await response.json();

if(result.success){

location.reload();

}

});

}



document.querySelectorAll('.approveComment').forEach(btn => {

btn.addEventListener('click', async function(){

const id = this.dataset.id;

const res = await fetch(`/admin/jobs/comments/${id}/approve`,{

method:"POST",

headers:{
'X-CSRF-TOKEN':'{{ csrf_token() }}'
}

});

const data = await res.json();

if(data.success){

location.reload();

}

});

});

</script>

@endsection