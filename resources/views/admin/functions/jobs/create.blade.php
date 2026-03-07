{{-- ═══════════════════════════════════════════════════════════════════════
     resources/views/admin/jobs/create.blade.php
     Create New Job — all roles that canManageJobs()
     Extends: layouts.staff
 ═══════════════════════════════════════════════════════════════════════ --}}
@extends('layouts.staff')
@section('title', 'Create New Job')

@section('content')
<div class="pb-layout-3col">
<div class="pb-col-left">

    {{-- ── Flash messages ─────────────────────────────────────────────── --}}
    @if(session('success'))
        <div class="pb-alert pb-alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="pb-alert pb-alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <style>
            .pb-input{
                display: block;
                background: none;
            }
        </style>
    {{-- ── Page header ────────────────────────────────────────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-1">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">Create New Job</div>
                <div class="pb-card-subtitle">Log a new client print job into the production tracker</div>
            </div>
            <a href="{{ route('admin.jobs.index') }}" class="pb-btn pb-btn-sm" style="background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);color:#9CA3AF;">
                ← Back to Jobs
            </a>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════════
         FORM
    ══════════════════════════════════════════════════════════════════ --}}
    <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- ── Section 1 · Client Information ────────────────────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-2">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">
                    <span class="pb-nav-badge" style="background:rgba(220,38,38,.15);color:#F87171;margin-right:.5rem">01</span>
                    Client Information
                </div>
                <div class="pb-card-subtitle">Contact details for the client placing this job</div>
            </div>
        </div>

        <div class="pb-form-grid p-4">

            <div class="pb-form-group text-sm">
                <label class="pb-label text-sm" for="client_name">Client / Company Name <span class="pb-required">*</span></label>
                <input class="pb-input rounded-lg  w-1/2 @error('client_name') pb-input-error @enderror"
                       id="client_name" name="client_name" type="text"
                       value="{{ old('client_name') }}"
                       placeholder="e.g. Alet Inspirationz Ltd" required>
                @error('client_name')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="client_phone">Phone Number <span class="pb-required">*</span></label>
                <input class="pb-input @error('client_phone') pb-input-error @enderror"
                       id="client_phone" name="client_phone" type="tel"
                       value="{{ old('client_phone') }}"
                       placeholder="+234 800 000 0000" required>
                @error('client_phone')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="client_email">Email Address</label>
                <input class="pb-input @error('client_email') pb-input-error @enderror"
                       id="client_email" name="client_email" type="email"
                       value="{{ old('client_email') }}"
                       placeholder="client@example.com">
                @error('client_email')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group pb-col-span-2">
                <label class="pb-label" for="client_address">Client Address</label>
                <textarea class="pb-input pb-textarea @error('client_address') pb-input-error @enderror"
                          id="client_address" name="client_address"
                          rows="2" placeholder="Street, City, State">{{ old('client_address') }}</textarea>
                @error('client_address')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>

    {{-- ── Section 2 · Job Specification ──────────────────────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-3">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">
                    <span class="pb-nav-badge" style="background:rgba(192,38,211,.15);color:#E879F9;margin-right:.5rem">02</span>
                    Job Specification
                </div>
                <div class="pb-card-subtitle">Define what is being produced for this job</div>
            </div>
        </div>

        <div class="pb-form-grid">

            <div class="pb-form-group">
                <label class="pb-label" for="job_type">Job Type <span class="pb-required">*</span></label>
                <select class="pb-input pb-select @error('job_type') pb-input-error @enderror"
                        id="job_type" name="job_type" required>
                    <option value="">— Select job type —</option>
                    @foreach($jobTypes as $type)
                        <option value="{{ $type }}" {{ old('job_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('job_type')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="size_format">Size / Format <span class="pb-required">*</span></label>
                <input class="pb-input @error('size_format') pb-input-error @enderror"
                       id="size_format" name="size_format" type="text"
                       value="{{ old('size_format') }}"
                       placeholder="e.g. A4, 90×50mm, 60×90cm" required>
                @error('size_format')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="quantity">Quantity <span class="pb-required">*</span></label>
                <input class="pb-input @error('quantity') pb-input-error @enderror"
                       id="quantity" name="quantity" type="number" min="1"
                       value="{{ old('quantity', 1) }}" required>
                @error('quantity')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="material">Material / Substrate</label>
                <select class="pb-input pb-select @error('material') pb-input-error @enderror"
                        id="material" name="material">
                    <option value="">— Select material (optional) —</option>
                    @foreach($materials as $mat)
                        <option value="{{ $mat }}" {{ old('material') === $mat ? 'selected' : '' }}>{{ $mat }}</option>
                    @endforeach
                </select>
                @error('material')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="finish">Finish</label>
                <select class="pb-input pb-select @error('finish') pb-input-error @enderror"
                        id="finish" name="finish">
                    <option value="">— Select finish (optional) —</option>
                    @foreach($finishes as $finish)
                        <option value="{{ $finish }}" {{ old('finish') === $finish ? 'selected' : '' }}>{{ $finish }}</option>
                    @endforeach
                </select>
                @error('finish')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group pb-col-span-2">
                <label class="pb-label" for="special_instructions">Special Instructions / Notes</label>
                <textarea class="pb-input pb-textarea"
                          id="special_instructions" name="special_instructions"
                          rows="3"
                          placeholder="Any specific requirements, colour references, bleed specs, delivery details…">{{ old('special_instructions') }}</textarea>
            </div>

        </div>
    </div>

    {{-- ── Section 3 · Scheduling & Priority ──────────────────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">
                    <span class="pb-nav-badge" style="background:rgba(234,179,8,.15);color:#FCD34D;margin-right:.5rem">03</span>
                    Scheduling & Priority
                </div>
                <div class="pb-card-subtitle">Set the brief date and urgency level for this job</div>
            </div>
        </div>

        <div class="pb-form-grid">

            <div class="pb-form-group">
                <label class="pb-label" for="brief_date">Brief Date <span class="pb-required">*</span></label>
                <input class="pb-input @error('brief_date') pb-input-error @enderror"
                       id="brief_date" name="brief_date" type="date"
                       value="{{ old('brief_date', date('Y-m-d')) }}" required>
                @error('brief_date')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="expected_delivery_date">Expected Delivery Date</label>
                <input class="pb-input @error('expected_delivery_date') pb-input-error @enderror"
                       id="expected_delivery_date" name="expected_delivery_date" type="date"
                       value="{{ old('expected_delivery_date') }}">
                @error('expected_delivery_date')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="priority">Priority Level <span class="pb-required">*</span></label>
                <select class="pb-input pb-select @error('priority') pb-input-error @enderror"
                        id="priority" name="priority" required>
                    <option value="">— Select priority —</option>
                    @foreach(['🔴 Urgent', '🟡 Normal', '🟢 Low'] as $p)
                        <option value="{{ $p }}" {{ old('priority', '🟡 Normal') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('priority')
                    <span class="pb-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="pb-form-group">
                <label class="pb-label" for="brief_received_by">Brief Received By</label>
                <input class="pb-input" id="brief_received_by" name="brief_received_by" type="text"
                       value="{{ $admin->full_name ?? $admin->first_name . ' ' . $admin->last_name }}" readonly
                       style="opacity:.6;cursor:not-allowed">
                <span class="pb-field-hint">Auto-filled from your account</span>
            </div>

        </div>
    </div>

    {{-- ── Section 4 · Design File (optional at intake) ───────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header">
            <div>
                <div class="pb-card-title">
                    <span class="pb-nav-badge" style="background:rgba(59,130,246,.15);color:#93C5FD;margin-right:.5rem">04</span>
                    Design File <span style="font-weight:400;color:#6B7280;font-size:.8rem">(optional at intake)</span>
                </div>
                <div class="pb-card-subtitle">Upload client artwork if already available — PDF, AI, PSD, or EPS</div>
            </div>
        </div>

        <div class="pb-form-grid">
            <div class="pb-form-group pb-col-span-2">
                <label class="pb-label" for="design_file">Artwork File</label>
                <input class="pb-input pb-input-file"
                       id="design_file" name="design_file" type="file"
                       accept=".pdf,.ai,.psd,.eps,.png,.jpg,.jpeg">
                <span class="pb-field-hint">Accepted: PDF, AI, PSD, EPS, PNG, JPG · Max 20 MB</span>
            </div>
        </div>
    </div>

    {{-- ── Submit ──────────────────────────────────────────────────────── --}}
    <div class="pb-card pb-fade-up pb-delay-4">
        <div class="pb-card-header" style="border-bottom:none;padding-bottom:.5rem">
            <div class="pb-card-subtitle">
                Once submitted, a job number (PB-YYYY-XXXX) and a draft invoice will be automatically generated.
                The client will receive an invoice email if their email address was provided.
            </div>
        </div>
        <div class="flex items-center gap-3 px-6 pb-6">
            <button type="submit" class="pb-btn pb-btn-success">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Create Job & Generate Invoice
            </button>
            <a href="{{ route('admin.jobs.index') }}" class="pb-btn pb-btn-sm"
               style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.12);color:#9CA3AF">
                Cancel
            </a>
        </div>
    </div>

    </form>

</div>
</div>
@endsection