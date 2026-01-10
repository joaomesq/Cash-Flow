<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="main">
        <div class="py-6 bg-white">
            <h2>Totais gerados</h2>
            <livewire:valores.totais />
        </div>
        
        <div classs="py-6 bg-white">
            <h2>Totais por periodo</h2>
            <livewire:valores.totais-periodo />
        </div>

        <div class="py-6 bg-white">
            <h2>Últimas transações</h2>
            <livewire:transacao.ultimas-transacoes />
        </div>
        
        <div class="py-6 bg-white">
            <h2>Resumo de gasto por descrição</h2>
            <livewire:transacao.resumo-transacoes />
        </div>
    </section>
</x-app-layout>
