<x-guest-layout>
    <section class="mt-8 shadow-lg rounded-lg flex flex-col w-[400px] justify-center md:w-[500px] lg:w-[90%] lg:px-12 lg:grid lg:grid-cols-2">
        <div class="w-full bg-cyan-500 text-white px-6 py-6 lg:p-8 rounded-t-lg lg:rounded-none lg:rounded-s-lg">
            <h2 class="font-bold text-lg mb-2 mt-2">Cash Flow - Chanax</h2>
            <p>"Junte-se a nós! Aqui você tem o controle da movimentação do seu dinheiro.
                Estamos aqui para ajudar a tronar sua vida financeira mais organizada e eficiente"
            </p>
        </div>

        <div class="form bg-white rounded-b-lg px-6 py-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="lg:grid lg:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label for="name" class="text-gray-900">Nome</label>
                    <x-text-input id="name"  placeholder="Nome" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="text-gray-900">E-mail</label>
                    <x-text-input id="email"  placeholder="E-mail" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="text-gray-900">Senha</label>
                    <x-text-input id="password" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="password"  placeholder="Senha" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="text-gray-900">Confirmar Senha</label>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full dark:bg-white dark:text-gray-900"
                            type="password" name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                </div>

                <div class="flex items-center justify-between w-full p-2">
                    <a class="underline text-sm text-gray-900 dark:text-gray-900 hover:text-gray-500 dark:hover:text-gray-500 rounded-md" href="{{ route('login') }}">
                        {{ __('Já tenho uma conta') }}
                    </a>

                    <button class="font-medium bg-cyan-500 text-white hover:bg-gray-400 uppercase rounded p-2 mb-2">
                        {{ __('Registar') }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
