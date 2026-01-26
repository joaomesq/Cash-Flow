<x-guest-layout>
    <section class="mt-4">
        <div class="text w-[300px] md:w-[450px] h-[180px] md:h-[150px] text-white px-6">
            <h2 class="font-semibold text-lg mb-2 mt-2">Cash Flow - Chanax</h2>
            <p>"Junte-se a nós! Aqui você tem o controle da movimentação do seu dinheiro.
                Estamos aqui para ajudar a tronar sua vida financeira mais organizada e eficiente"
            </p>
        </div>

        <div class="from-register p-4 px-8 bg-white">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="text-gray-600">Nome</label>
                    <x-text-input id="name" class="block mt-1 w-full dark:bg-white dark:text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="text-gray-600">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full dark:bg-white dark:text-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="text-gray-600">Senha</label>
                    <x-text-input id="password" class="block mt-1 w-full dark:bg-white dark:text-black" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="text-gray-600">Confirmar Senha</label>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full dark:bg-white dark:text-black"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-900 dark:text-gray-900 hover:text-gray-500 dark:hover:text-gray-500 rounded-md" href="{{ route('login') }}">
                        {{ __('Já tenho uma conta') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Registar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
