{{-- ── IT / Super Admin Dashboard ──────────────────────────────────────────
     Access: ALL data, ALL functions, ALL roles, NO limits
     ─────────────────────────────────────────────────────────────────────── --}}
     @extends('layouts.staff')
     @section('title', 'Manage Users')

@section('content')
<div class="pb-layout-3col">
<div class="pb-col-left">

    {{-- Staff pending activation --}}
    @if(session('success'))
    <div class="pb-alert pb-alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="pb-alert pb-alert-danger">{{ session('error') }}</div>
@endif
<div class="pb-card pb-fade-up pb-delay-4">
    <div class="pb-card-header">
        <div>
            <div class="pb-card-title">Pending Staff Activations</div>
            <div class="pb-card-subtitle">New staff awaiting Super Admin approval</div>
        </div>
        <span class="pb-nav-badge danger">{{ $pendingActivations->count() }}</span>
    </div>
    <div class="pb-table-wrap">
        <table class="pb-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingActivations as $pedingStaff)
                    <tr>
                        <td class="pb-cell-strong"><img src="{{ $pedingStaff->photo ? asset('storage/photos/' . $pedingStaff->photo) : asset('images/default.png') }}" alt="{{ $pedingStaff->name }}" /></td>
                        <td class="pb-cell-strong">{{ $pedingStaff->first_name . ' ' . $admin->last_name }}</td>
                        <td class="pb-cell-mono">{{ $pedingStaff->staff_role }}</td>
                        <td class="pb-cell-muted">{{ $pedingStaff->created_at->format('M d, Y') }}</td>
                        <td class="pb-cell-mono">{{ $pedingStaff->email }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <form action="{{ route('admin.activate', $pedingStaff->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="pb-btn pb-btn-success pb-btn-sm" type="submit">Activate</button>
                                </form>
                                <form action="{{ route('admin.reject', $pedingStaff->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="pb-btn pb-btn-danger pb-btn-sm" type="submit">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center pb-cell-muted">No pending activations</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

 {{-- All Staff --}}
    @if(session('success'))
    <div class="pb-alert pb-alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="pb-alert pb-alert-danger">{{ session('error') }}</div>
@endif
<div class="pb-card pb-fade-up pb-delay-4">
    <div class="pb-card-header">
        <div>
            <div class="pb-card-title">All Staff</div>
            <div class="pb-card-subtitle">List of everyone involved in Printbuka Production process</div>
        </div>
        <span class="pb-nav-badge bg-blue-500">Total registered Admins {{ $admin->count() }}</span>
    </div>
    <div class="pb-table-wrap">
        <table class="pb-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allAdmins as $admin)
                    <tr>
                        <td class="pb-cell-strong">{{ $admin->first_name . ' ' . $admin->last_name }}</td>
                        <td class="pb-cell-mono">{{ $admin->staff_role }}</td>
                        <td class="pb-cell-muted">{{ $admin->created_at->format('M d, Y') }}</td>
                        <td class="pb-cell-mono">{{ $admin->email }}</td>
                        <td>
                            <div class="pb-cell-actions">
                                <form action="{{ route('admin.deactivate', $admin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="pb-btn bg-yellow-500/10 hover:bg-yellow-400 hover:text-gray-950 text-yellow-400 pb-btn-sm" type="submit">Deactivate</button>
                                </form>
                                <form action="{{ route('admin.reject', $admin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="pb-btn pb-btn-danger pb-btn-sm" type="submit">Reject</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center pb-cell-muted">No pending activations</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
</div>
@endsection