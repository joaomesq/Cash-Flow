<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section>
        <div class="text h-[150px] text-white">
            <h2>Texto experimental</h2>
        </div>

        <div class="form text-black bg-white px-8 py-4">
            <h2 class="mb-4">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 inline-flex items-center">
                    <label for="remember_me px-2">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-100 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
                    </label>

                    <label for="forgot_password px-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-black hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </label>
                </div>

                <div class="mt-4">
                    <x-primary-button class="center">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <p class="">
                        <a class="text-sm text-gray-800 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                            {{ __('Criar Conta') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
