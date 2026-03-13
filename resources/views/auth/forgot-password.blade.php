<x-guest-layout>
    <section class="p-4 px-6 bg-white rounded-lg w-[400px] md:w-full">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceste a tua senha? Sem crise. Apenas envie o seu email e nós te enviaremos o link para definires uma nova senha.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="text-gray-600">{{__("Email")}}</label>
                <x-text-input id="email" class="block mt-1 w-full bg-transparent dark:bg-transparent text-black dark:text-gray-900" type="email" name="email" placeholder="E-mail" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-guest-layout>
