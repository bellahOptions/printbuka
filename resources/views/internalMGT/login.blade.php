<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login — {{ config('app.name', 'Printbuka') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex font-['DM_Sans']">

    {{-- LEFT BRAND PANEL --}}
    <div class="hidden lg:flex w-[46%] bg-gray-900 flex-col justify-between p-14 relative overflow-hidden border-r border-gray-800">
        {{-- Decorative rings --}}
        <div class="absolute -top-20 -right-20 w-80 h-80 border border-yellow-500/10 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-16 -left-16 w-56 h-56 border border-orange-500/10 rounded-full pointer-events-none"></div>
        <div class="absolute top-1/2 right-0 w-px h-40 bg-gradient-to-b from-transparent via-gray-700 to-transparent"></div>

        {{-- Brand --}}
        <div class="flex items-center gap-3 relative z-10">
            <img src="{{ asset('logo-dark.svg') }}" class="h-9" alt="Printbuka">
            <span class="text-xs tracking-[2px] uppercase text-gray-500 border-l border-gray-700 pl-3">Staff Portal</span>
        </div>

        {{-- Hero copy --}}
        <div class="relative z-10">
            <p class="text-xs tracking-[2.5px] uppercase text-yellow-500 mb-5 flex items-center gap-2">
                <span class="w-5 h-px bg-yellow-500 block"></span> Welcome Back
            </p>
            <h1 class="font-['Playfair_Display'] text-5xl font-bold leading-tight mb-5">
                Your work,<br><em class="not-italic text-yellow-400">your record.</em>
            </h1>
            <p class="text-gray-400 text-sm leading-relaxed max-w-xs font-light">
                Access evaluations, performance history, and HR communications — all in one secure place.
            </p>
        </div>

        {{-- Stats --}}
        <div class="flex gap-8 relative z-10">
            @foreach([['2025','Review Period'], ['100%','Confidential'], ['7','Sections']] as [$num, $label])
            <div>
                <div class="font-['Playfair_Display'] text-2xl font-bold text-white">{{ $num }}</div>
                <div class="text-[10px] tracking-widest uppercase text-gray-500 mt-0.5">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- RIGHT FORM PANEL --}}
    <div class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            {{-- Mobile brand --}}
            <div class="lg:hidden mb-10 text-center">
                <img src="{{ asset('logo-dark.svg') }}" class="h-8 mx-auto mb-3" alt="Printbuka">
            </div>

            {{-- Header --}}
            <div class="mb-8">
                <span class="inline-flex items-center gap-1.5 text-[10px] font-bold tracking-[2px] uppercase text-yellow-500 bg-yellow-500/10 px-3 py-1.5 rounded-sm mb-4">
                    <span class="text-[7px]">◆</span> Staff Login
                </span>
                <h2 class="font-['Playfair_Display'] text-3xl font-bold text-white mb-1.5">Sign in to your account</h2>
                <p class="text-gray-400 text-sm">Enter your Printbuka credentials to continue.</p>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mb-5 flex items-start gap-3 bg-green-500/10 border border-green-500/25 text-green-400 text-sm px-4 py-3 rounded-sm">
                    <span class="mt-0.5">✓</span> <span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('info'))
                <div class="mb-5 bg-blue-500/10 border border-blue-500/25 text-blue-400 text-sm px-4 py-3 rounded-sm">
                    {{ session('info') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-5 bg-red-500/10 border border-red-500/25 text-red-400 text-sm px-4 py-3 rounded-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login.post') }}" method="POST" autocomplete="off">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-400 mb-2 tracking-wide">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-sm pointer-events-none">✉</span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="you@printbuka.com"
                            class="w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm pl-9 pr-4 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors @error('email') border-red-500 @enderror">
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-xs font-semibold text-gray-400 mb-2 tracking-wide">Password</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-sm pointer-events-none">🔒</span>
                        <input type="password" name="password" id="login-pwd" required
                            placeholder="Your password"
                            class="w-full bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-600 rounded-sm pl-9 pr-10 py-3 text-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500/30 transition-colors">
                        <button type="button" onclick="togglePwd('login-pwd','toggle-icon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 text-sm" id="toggle-icon">👁</button>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded-sm accent-yellow-500">
                        <span class="text-sm text-gray-400">Remember me</span>
                    </label>
                    <a href="#" class="text-xs text-yellow-500 hover:text-yellow-400 font-medium">Forgot password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-[hsl(49,99%,57%)] hover:bg-yellow-400 text-gray-900 font-bold text-sm py-3.5 rounded-sm transition-all duration-200 hover:shadow-lg hover:shadow-yellow-500/20 hover:-translate-y-px flex items-center justify-center gap-2">
                    Sign In <span class="text-base transition-transform group-hover:translate-x-1">→</span>
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                New staff member?
                <a href="{{ route('admin.onboarding') }}" class="text-yellow-500 hover:text-yellow-400 font-semibold">Create an account</a>
            </p>

        </div>
    </div>

    <script>
    function togglePwd(inputId, btnId) {
        const i = document.getElementById(inputId);
        const b = document.getElementById(btnId);
        i.type = i.type === 'password' ? 'text' : 'password';
        b.textContent = i.type === 'password' ? '👁' : '🙈';
    }
    </script>
</body>
</html>
