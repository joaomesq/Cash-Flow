<x-guest-layout>
    <section>
        <div class="bg-white p-4 px-8 w-[300px] md:w-[450px] rounded">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="text-gray-600">Email</label>
                    <x-text-input id="email" class="block mt-1 w-full dark:bg-white dark:text-black" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="text-gray-600">Senha</label>
                    <x-text-input id="password" class="block mt-1 w-full dark:bg-white dark:text-gray-900" type="password" name="password" required autocomplete="new-password" />
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
                    <x-primary-button>
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
