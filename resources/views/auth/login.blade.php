<x-guest-layout>
    <div class="mb-6">
        <a href="{{ url('/') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-indigo-600 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Home
        </a>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-indigo-600" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Log in
            </button>
        </div>

        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                Sign up
            </a>
        </div>
    </form>
</x-guest-layout>
