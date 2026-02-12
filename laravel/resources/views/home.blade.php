<x-app-layout>
    <section class="dark:text-gray-300 text-white px-4 valores container mx-auto grid grid-cols-3 gap-4">
        <div class="saldo bg-blue-600 dark:bg-transparent dark:border-blue-600 dark:border dark:text-gray-300 p-4 text-white rounded-lg">
            <livewire:valores.saldo />
            <span class="border-t border-white/50 w-full block mt-4"></span>
            <p class="mt-2 text-sm font-light ">Conta corrente</p>
        </div>

        <div class="rounded-lg px-4 py-4 receita bg-green-600 dark:bg-transparent dark:border-green-600 dark:border ">
            <livewire:valores.receita periodo="mensal" />
            <span class="px-4 border-t border-white/50 w-full block mt-4"></span>
            <p class="mt-2 text-sm font-light ">Este mês</p>          
        </div>

        <div class="rounded-lg px-4 py-4 receita bg-red-600 dark:bg-transparent dark:border-red-600 dark:border ">
            <livewire:valores.despesa periodo="mensal" />
            <span class="px-4 border-t border-white/50 w-full block mt-4"></span>
            <p class="mt-2 text-sm font-light ">Este mês</p>          
        </div>
    </section>

    <section class="grafico px-4 mt-4">
        <livewire:graficos.fluxo-caixa />
    </section>

    <section class="transacoes-recentes px-4 mt-4">
        <livewire:transacao.ultimas-transacoes />
    </section>
</x-app-layout>