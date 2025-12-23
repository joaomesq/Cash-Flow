<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="main">
        <div class="py-6 bg-white">
            <livewire:transacao.ultimas-transacoes />
        </div>
    </section>
</x-app-layout>
