<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="mt-6">
        <div class="text w-[300px] md:w-[450px] h-[180px] md:h-[150px] text-white px-6">
            <h2 class="font-semibold text-lg mb-2">Cash Flow - Chanax</h2>
            <p>"Bem-vindo! Aqui você tem o controle da movimentação do seu dinheiro.
                Estamos aqui para ajudar a tronar sua vida financeira mais organizada e eficiente"
            </p>
        </div>

        <div class="form text-black bg-white px-8 py-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div>
                    <label for="email">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full dark:bg-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <!-- Password -->
                <div class="mt-4">
                    <label for="password">Password</label>
                    <x-text-input id="password" class="block mt-1 w-full dark:bg-white" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 grid grid-cols-2 justify-center gap-2  grid-items-center">
                    <label for="remember_me px-2">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-100 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
                    </label>

                    <label for="forgot_password px-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-black hover:text-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a sua password?') }}
                            </a>
                        @endif
                    </label>
                </div>

                <div class="mt-4 bg-red center gap-2">
                    <button class="w-full dark:bg-gray-300 dark:hover:bg-gray-200 text-black rounded p-2 mb-2">Log in</button>

                    <p class="text-center">
                        <a class="text-sm text-black hover:text-gray-500 dark:hover:text-gray-500" href="{{ route('register') }}">
                            {{ __('Criar Conta') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
