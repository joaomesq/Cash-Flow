<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="main">
        <div class="py-6 bg-white">
            <h2>Total de gastos e receitas e saldo disponível</h2>
            <livewire:valores.totais />
        </div>
        
        <div class="py-6 bg-white">
            <h2>Valores por periodo por periodo</h2>
            <livewire:valores.totais-periodo />

            <div>
                <h2>Percentagens</h2>
                <livewire:valores.percentagens />
            </div>
        </div>

        <div class="py-6 bg-white">
            <h2>Últimas transações</h2>
            <livewire:transacao.ultimas-transacoes />
        </div>
        
        <div class="py-6 bg-white">
            <h2>Valores por transação</h2>
            <livewire:transacao.resumo-transacoes />
        </div>
    </section>
</x-app-layout>
