<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white dark:bg-white p-6 rounded-lg ">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="'Email'" class="text-gray-800 dark:text-gray-800" />
            <x-text-input id="email"
                class="block mt-1 w-full bg-gray-100 dark:bg-gray-100 text-gray-900 dark:text-gray-900 border-gray-300 dark:border-gray-300"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-600" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" class="text-gray-800 dark:text-gray-800" />

            <x-text-input id="password"
                class="block mt-1 w-full bg-gray-100 dark:bg-gray-100 text-gray-900 dark:text-gray-900 border-gray-300 dark:border-gray-300"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center text-gray-800 dark:text-gray-800">
                <input id="remember_me" type="checkbox"
                    class="rounded bg-gray-100 dark:bg-gray-100 border-gray-300 dark:border-gray-300 text-indigo-600 dark:text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
