<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Onboarding — {{ config('app.name', 'Printbuka') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen font-['DM_Sans']">

    {{-- TOP BAR --}}
    <header class="bg-gray-900 border-b md:w-1/2 mx-auto border-gray-800 px-6 md:px-12 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3 space-x-3">
            <img src="{{ asset('logo-dark.svg') }}" class="h-8" alt="Printbuka">
            <span class="text-xs tracking-[2px] uppercase text-gray-500 border-l border-gray-700 pl-3 hidden sm:inline">Staff Onboarding</span>
        </div>
        <a href="{{ route('admin.login') }}" class="text-xs w-10/12 p-2 text-gray-400 hover:text-yellow-400 transition-colors">
            Already registered? <span class="text-yellow-500 font-semibold">Sign in →</span>
        </a>
    </header>

    {{-- HERO STRIP --}}
    <div class="bg-gray-900 md:w-1/2 mx-auto border-b border-gray-800 px-6 md:px-12 py-10 relative overflow-hidden">
        <div class="absolute -top-16 -right-16 w-64 h-64 border border-yellow-500/8 rounded-full pointer-events-none"></div>
        <div class="max-w-3xl relative z-10 ">
            <p class="text-[10px] tracking-[2.5px] uppercase text-yellow-500 mb-3 flex items-center gap-2">
                <span class="w-4 h-px bg-yellow-500 block"></span> Welcome to the Team
            </p>
            <h1 class="font-['Playfair_Display'] text-3xl md:text-4xl font-bold text-white mb-3 leading-tight">
                Create your <span class="text-yellow-400">staff account</span>
            </h1>
            <p class="text-gray-400 text-sm max-w-lg leading-relaxed font-light">
                Complete the form below to register. You'll receive an email verification link, then a SuperAdmin will activate your account before you can log in.
            </p>
        </div>
    </div>

    {{-- MAIN FORM --}}
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-10 pb-20">

        {{-- Flash messages --}}
        @if (session('success'))
            <div class="mb-6 flex items-start gap-3 bg-green-500/10 border border-green-500/25 text-green-400 text-sm px-5 py-4 rounded-sm">
                <span class="text-lg mt-0.5">✓</span>
                <div>
                    <p class="font-semibold mb-0.5">Account Created</p>
                    <p class="text-green-400/80">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500/25 text-red-400 text-sm px-5 py-4 rounded-sm">
                <p class="font-semibold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1 text-red-400/80">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('onboard.staff') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="onboard-form">
            @csrf

            {{-- ── SECTION 1: PERSONAL DETAILS ── --}}
            <div class="bg-gray-900 border border-gray-800 rounded-sm p-6 md:p-8 mb-5 relative">
                <div class="absolute -top-3 left-6 bg-yellow-500 text-gray-900 text-[10px] font-bold tracking-[1.5px] uppercase px-3 py-1 rounded-sm">Personal Details</div>

                <h2 class="font-['Playfair_Display'] text-xl font-bold text-white mb-1">Who are you?</h2>
                <p class="text-gray-500 text-xs mb-7">Your basic information as it will appear on your staff profile.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-2">First Name <span class="text-red-400">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required
                            placeholder="First name"
                            class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('first_name') border-red-500 @enderror">
                        @error('first_name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-2">Last Name <span class="text-red-400">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required
                            placeholder="Last name"
                            class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('last_name') border-red-500 @enderror">
                        @error('last_name')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-2">Email Address <span class="text-red-400">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="you@printbuka.com"
                            class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('email') border-red-500 @enderror">
                        @error('email')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 mb-2">Phone Number <span class="text-red-400">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                            placeholder="+234 000 0000 000"
                            class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('phone') border-red-500 @enderror">
                        @error('phone')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Home Address <span class="text-red-400">*</span></label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                        placeholder="e.g. 14 Broad Street, Lagos"
                        class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('address') border-red-500 @enderror">
                    @error('address')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Date of Birth <span class="text-red-400">*</span>
                        <span class="font-normal text-gray-500 ml-1">— Must be 18 or older</span>
                    </label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                        max="{{ now()->subYears(18)->format('Y-m-d') }}"
                        class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('date_of_birth') border-red-500 @enderror">
                    @error('date_of_birth')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- ── SECTION 2: ROLE ── --}}
            <div class="bg-gray-900 border border-gray-800 rounded-sm p-6 md:p-8 mb-5 relative">
                <div class="absolute -top-3 left-6 bg-orange-600 text-white text-[10px] font-bold tracking-[1.5px] uppercase px-3 py-1 rounded-sm">Role & Department</div>

                <h2 class="font-['Playfair_Display'] text-xl font-bold text-white mb-1">Your position</h2>
                <p class="text-gray-500 text-xs mb-7">Select your department and upload a professional profile photo.</p>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Staff Role <span class="text-red-400">*</span></label>
                    <select name="staff_role" id="staff-role" required onchange="toggleOtherRole()"
                        class="w-full bg-gray-800 border border-gray-700 text-gray-100 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors cursor-pointer @error('staff_role') border-red-500 @enderror">
                        <option value="">— Select your role —</option>
                        <option value="IT" {{ old('staff_role')=='IT' ? 'selected' : '' }}>IT</option>
                        <option value="Designer" {{ old('staff_role')=='Designer' ? 'selected' : '' }}>Graphic Designer</option>
                        <option value="Operations Manager" {{ old('staff_role')=='Operations Manager' ? 'selected' : '' }}>Operations Manager</option>
                        <option value="Operator" {{ old('staff_role')=='Operator' ? 'selected' : '' }}>Machine Operator</option>
                        <option value="customer_service" {{ old('staff_role')=='customer_service' ? 'selected' : '' }}>Customer Service / Marketing</option>
                        <option value="QC" {{ old('staff_role')=='QC' ? 'selected' : '' }}>Quality Control & Packaging</option>
                        <option value="HR" {{ old('staff_role')=='HR' ? 'selected' : '' }}>HR</option>
                        <option value="Operations" {{ old('staff_role')=='Operations' ? 'selected' : '' }}>Operations</option>
                        <option value="other" {{ old('staff_role')=='other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('staff_role')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>

                <div id="other-role-wrap" class="{{ old('staff_role')=='other' ? '' : 'hidden' }} mb-4">
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Please specify your role <span class="text-red-400">*</span></label>
                    <input type="text" name="other_role" value="{{ old('other_role') }}" id="other-role"
                        placeholder="Describe your role"
                        class="field-input w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm px-3.5 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('other_role') border-red-500 @enderror">
                    @error('other_role')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- PHOTO UPLOAD --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-2">
                        Profile Photo <span class="text-red-400">*</span>
                        <span class="font-normal text-gray-500 ml-1">— JPG or PNG only, max 2 MB</span>
                    </label>

                    {{-- Custom drop zone --}}
                    <div id="drop-zone"
                        class="border-2 border-dashed border-gray-700 rounded-sm p-6 text-center cursor-pointer transition-colors hover:border-yellow-500/50 relative"
                        onclick="document.getElementById('photo-input').click()"
                        ondragover="event.preventDefault(); this.classList.add('border-yellow-500')"
                        ondragleave="this.classList.remove('border-yellow-500')"
                        ondrop="handleDrop(event)">

                        <div id="drop-placeholder">
                            <div class="text-3xl mb-2">📷</div>
                            <p class="text-sm text-gray-400 mb-1">Click to upload or drag & drop</p>
                            <p class="text-xs text-gray-600">JPG, JPEG, PNG — Max 2 MB</p>
                        </div>

                        <div id="photo-preview" class="hidden flex-col items-center gap-3">
                            <img id="preview-img" src="" alt="Preview" class="w-24 h-24 rounded-full object-cover border-2 border-yellow-500">
                            <p id="preview-name" class="text-xs text-gray-400"></p>
                            <p class="text-xs text-yellow-500">Click to change</p>
                        </div>
                    </div>

                    {{-- Hidden actual input --}}
                    <input type="file" name="photo" id="photo-input" accept=".jpg,.jpeg,.png" class="hidden"
                        onchange="handleFileSelect(this)">

                    {{-- Client-side error message --}}
                    <p id="photo-error" class="text-xs text-red-400 mt-1 hidden"></p>
                    @error('photo')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- ── SECTION 3: SECURITY ── --}}
            <div class="bg-gray-900 border border-gray-800 rounded-sm p-6 md:p-8 mb-5 relative">
                <div class="absolute -top-3 left-6 bg-gray-700 text-gray-100 text-[10px] font-bold tracking-[1.5px] uppercase px-3 py-1 rounded-sm">Account Security</div>

                <h2 class="font-['Playfair_Display'] text-xl font-bold text-white mb-1">Create a password</h2>
                <p class="text-gray-500 text-xs mb-7">Minimum 8 characters. Mix of letters, numbers, and symbols recommended.</p>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Password <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <input type="password" name="password" id="pwd1" required
                            placeholder="Create a password"
                            oninput="checkStrength(this.value)"
                            class="w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm pl-3.5 pr-10 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('password') border-red-500 @enderror">
                        <button type="button" onclick="togglePwd('pwd1','t1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 text-sm" id="t1">👁</button>
                    </div>
                    <div class="mt-2">
                        <div class="h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div id="strength-bar" class="h-full rounded-full transition-all duration-300" style="width:0%"></div>
                        </div>
                        <p id="strength-text" class="text-[11px] text-gray-500 mt-1">Enter a password</p>
                    </div>
                    @error('password')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-400 mb-2">Confirm Password <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="pwd2" required
                            placeholder="Repeat your password"
                            class="w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm pl-3.5 pr-10 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors">
                        <button type="button" onclick="togglePwd('pwd2','t2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 text-sm" id="t2">👁</button>
                    </div>
                </div>
            </div>

            {{-- NOTICE --}}
            <div class="bg-yellow-500/8 border border-yellow-500/20 rounded-sm p-5 mb-6 flex gap-3 items-start">
                <span class="text-yellow-500 text-lg mt-0.5">ℹ</span>
                <div>
                    <p class="text-sm text-yellow-400 font-semibold mb-1">What happens next?</p>
                    <p class="text-xs text-gray-400 leading-relaxed">
                        After submitting, you'll receive a verification email. Once you verify your email, a SuperAdmin must activate your account before you can log in. This process ensures only verified Printbuka staff gain access.
                    </p>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="text-center">
                <button type="submit"
                    class="inline-flex items-center gap-2.5 bg-[hsl(49,99%,57%)] hover:bg-yellow-400 text-gray-900 font-bold px-14 py-4 rounded-sm text-sm transition-all duration-200 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-px">
                    Create Account <span class="text-base">→</span>
                </button>
                <p class="text-xs text-gray-600 mt-3">By registering you agree to Printbuka's staff portal terms.</p>
            </div>

        </form>
    </div>

    <script>
    // ── Toggle password visibility ────────────────────────────────────────
    function togglePwd(id, btnId) {
        const i = document.getElementById(id);
        const b = document.getElementById(btnId);
        i.type = i.type === 'password' ? 'text' : 'password';
        b.textContent = i.type === 'password' ? '👁' : '🙈';
    }

    // ── Password strength meter ───────────────────────────────────────────
    function checkStrength(val) {
        const bar  = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');
        if (!val) { bar.style.width='0%'; text.textContent='Enter a password'; bar.style.background=''; return; }
        let score = 0;
        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;
        const levels = [
            { w:'25%', c:'#ef4444', t:'Weak — too short or simple' },
            { w:'50%', c:'#f97316', t:'Fair — add numbers or symbols' },
            { w:'75%', c:'#eab308', t:'Good — almost there!' },
            { w:'100%',c:'#22c55e', t:'Strong — great password!' },
        ];
        const l = levels[score-1] || levels[0];
        bar.style.width = l.w; bar.style.background = l.c;
        text.textContent = l.t; text.style.color = l.c;
    }

    // ── Show/hide "other role" input ──────────────────────────────────────
    function toggleOtherRole() {
        const sel  = document.getElementById('staff-role');
        const wrap = document.getElementById('other-role-wrap');
        const inp  = document.getElementById('other-role');
        const show = sel.value === 'other';
        wrap.classList.toggle('hidden', !show);
        inp.required = show;
    }

    // ── Client-side image validation ─────────────────────────────────────
    const ALLOWED_TYPES = ['image/jpeg', 'image/png'];
    const ALLOWED_EXTS  = ['jpg', 'jpeg', 'png'];
    const MAX_SIZE_BYTES = 2 * 1024 * 1024; // 2 MB

    function validateImageFile(file) {
        if (!file) return 'Please upload a profile photo.';
        const ext = file.name.split('.').pop().toLowerCase();
        if (!ALLOWED_EXTS.includes(ext))          return 'Only JPG and PNG files are allowed.';
        if (!ALLOWED_TYPES.includes(file.type))    return 'Invalid file type. Only JPG and PNG are accepted.';
        if (file.size > MAX_SIZE_BYTES)            return 'File exceeds the 2 MB limit.';
        return null;
    }

    function showPhotoPreview(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-name').textContent = file.name + ' (' + (file.size/1024).toFixed(1) + ' KB)';
            document.getElementById('drop-placeholder').classList.add('hidden');
            document.getElementById('photo-preview').classList.remove('hidden');
            document.getElementById('photo-preview').classList.add('flex');
        };
        reader.readAsDataURL(file);
    }

    function handleFileSelect(input) {
        const errEl = document.getElementById('photo-error');
        if (!input.files.length) return;
        const file  = input.files[0];
        const error = validateImageFile(file);
        if (error) {
            errEl.textContent = error;
            errEl.classList.remove('hidden');
            input.value = '';
            document.getElementById('drop-placeholder').classList.remove('hidden');
            document.getElementById('photo-preview').classList.add('hidden');
            return;
        }
        errEl.classList.add('hidden');
        showPhotoPreview(file);
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('drop-zone').classList.remove('border-yellow-500');
        const file = e.dataTransfer.files[0];
        if (!file) return;
        const error = validateImageFile(file);
        const errEl = document.getElementById('photo-error');
        if (error) { errEl.textContent = error; errEl.classList.remove('hidden'); return; }
        errEl.classList.add('hidden');

        // Assign to the real input via DataTransfer
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('photo-input').files = dt.files;
        showPhotoPreview(file);
    }

    // ── Block form submit if client-side photo check fails ───────────────
    document.getElementById('onboard-form').addEventListener('submit', function(e) {
        const input = document.getElementById('photo-input');
        const errEl = document.getElementById('photo-error');
        if (!input.files.length) {
            e.preventDefault();
            errEl.textContent = 'Please upload a profile photo.';
            errEl.classList.remove('hidden');
            document.getElementById('drop-zone').scrollIntoView({ behavior:'smooth', block:'center' });
        }
    });

    // Restore "other" visibility on back-navigation
    toggleOtherRole();
    </script>
</body>
</html>
