{{-- ── Printbuka Jobs Dashboard ──────────────────────────────────────────
     Access: IT / Super Admin
     ───────────────────────────────────────────────────────────────────── --}}
@extends('layouts.staff')
@section('title', 'Manage Jobs')

@section('content')

<div class="pb-layout-3col">
<div class="pb-col-left">

{{-- Alerts --}}
@if(session('success'))
<div class="pb-alert pb-alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="pb-alert pb-alert-danger">{{ session('error') }}</div>
@endif


{{-- Job List Card --}}
<div class="pb-card pb-fade-up pb-delay-4">

<div class="pb-card-header">
<div>
<div class="pb-card-title">Print Jobs</div>
<div class="pb-card-subtitle">
All print production jobs in the system
</div>
</div>

<span class="pb-nav-badge bg-blue-500">
Total Jobs {{ $jobs->count() }}
</span>
</div>


<div class="pb-table-wrap">

<table class="pb-table">

<thead>
<tr>
<th>Job ID</th>
<th>Client</th>
<th>Job Type</th>
<th>Status</th>
<th>Created</th>
<th>Assigned To</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@forelse($jobs as $job)

<tr>

<td class="pb-cell-mono">
#{{ $job->id }}
</td>

<td class="pb-cell-strong">
{{ $job->client_name }}
</td>

<td>
{{ $job->job_type ?? 'N/A' }}
</td>

<td>
<span class="pb-nav-badge 
{{ $job->status == 'Completed' ? 'bg-green-500' : '' }}
{{ $job->status == 'Pending' ? 'bg-yellow-500' : '' }}
{{ $job->status == 'In Progress' ? 'bg-blue-500' : '' }}
">
{{ $job->status }}
</span>
</td>

<td class="pb-cell-muted">
{{ $job->created_at->format('M d, Y') }}
</td>

<td class="pb-cell-mono">
{{ $job->assigned_to ?? 'Unassigned' }}
</td>

<td>

<div class="pb-cell-actions">

<a href="{{ route('jobs.show', $job->id) }}"
class="pb-btn pb-btn-sm bg-blue-500/10 text-blue-400 hover:bg-blue-400 hover:text-gray-900">
View
</a>

<a href="{{ route('jobs.edit', $job->id) }}"
class="pb-btn pb-btn-sm bg-purple-500/10 text-purple-400 hover:bg-purple-400 hover:text-gray-900">
Edit
</a>

<a href="{{ route('invoice.create', $job->id) }}"
class="pb-btn pb-btn-sm pb-btn-success">
Create Invoice
</a>

<form action="{{ route('jobs.destroy', $job->id) }}"
method="POST"
style="display:inline">

@csrf
@method('DELETE')

<button type="submit"
class="pb-btn pb-btn-danger pb-btn-sm"
onclick="return confirm('Delete this job?')">
Delete
</button>

</form>

</div>

</td>

</tr>

@empty

<tr>
<td colspan="7" class="text-center pb-cell-muted">
No Jobs Found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>


{{-- Pagination --}}
<div class="mt-4">
{{ $jobs->links() }}
</div>


</div>
</div>

@endsection