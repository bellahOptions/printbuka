<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="my-2">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>
        <div class="my-2">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>
        <div class="my-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>       

        <!-- Password -->
        
        <div class="my-2">
            <label for="password">Password</label>
            <input type="password" name="password" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> 
        
        <div class="my-2">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="block w-full rounded-lg p-3 mt-2 border-2 border-pink-300 ring-2 focus:ring-pink-500 focus:border-pink-500" required autofocus/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> 
            <div class="">
                <button type="submit" class="bg-pink-500 text-white font-bold w-full p-3 my-2 rounded-xl">LOG IN</button>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-pink-500 hover:text-pink-700 font-bold">Log in</a></p>
            </div>
    </form>
</x-guest-layout>
