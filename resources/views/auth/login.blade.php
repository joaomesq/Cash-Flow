<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="shadow-lg mt-20  rounded-lg flex flex-col w-[400px] justify-center md:w-[500px] lg:w-[90%] lg:px-12 lg:grid lg:grid-cols-2">
        <div class="w-full bg-cyan-500 text-white px-6 py-6 lg:p-8 rounded-t-lg lg:rounded-none lg:rounded-s-lg">
            <h2 class="font-bold text-lg mb-2">Cash Flow - Chanax</h2>
            <p>"Bem-vindo! Aqui você tem o controle da movimentação do seu dinheiro.
                Estamos aqui para ajudar a tronar sua vida financeira mais organizada e eficiente"
            </p>
        </div>

        <div class="form bg-white rounded-b-lg px-6 py-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Address -->
                <div>
                    <label class="text-gray-600 hidden" for="email">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="E--mail"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="text-gray-600 hidden">Password</label>
                    <x-text-input id="password" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 grid grid-cols-2 justify-center gap-2  grid-items-center">
                    <label for="remember_me px-2">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-100 dark:border-gray-700 text-indigo-600 shadow-sm" name="remember">
                        <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
                    </label>

                    <label for="forgot_password px-2">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-700 hover:text-gray-500 rounded-md" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a sua password?') }}
                            </a>
                        @endif
                    </label>
                </div>

                <div class="mt-4 bg-red center gap-2">
                    <button class="w-full font-medium bg-cyan-500 text-white hover:bg-gray-300 hover:text-blackds uppercase rounded p-2 mb-2">Log in</button>

                    <p class="text-center">
                        <a class="text-sm text-black hover:text-gray-500 dark:hover:text-gray-500 uppercase" href="{{ route('register') }}">
                            {{ __('Criar Conta') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
