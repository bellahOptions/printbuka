<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
        <label for="email">Password</label>
            <input type="password" name="password" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
            <div class="">
                <button type="submit" class="bg-pink-500 text-white font-bold w-full p-3 my-2 rounded-xl">LOG IN</button>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <div class="mt-4">
                <p class="text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-pink-500 hover:text-pink-700 font-bold">Sign up</a></p>
            </div>
            {{-- Google and other sign in methods --}}
                <div class="mt-6">
                    <p class="text-sm text-gray-600 mb-2">Or sign in with</p>
                    <div class="flex space-x-4">
                        <a href="#" class="flex items-center justify-center w-full py-2 border border-gray-300 rounded-lg hover:bg-gray-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google Logo" class="h-5 me-2">
                            Google
                        </a>
                        <!-- Add more social login options here -->
                    </div>
                </div>
        </div>
    </form>
</x-guest-layout>
