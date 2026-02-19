<x-app-layout>
    <section class="main p-4">
        <div class="dark:text-gray-300 text-white mb-4 valores container mx-auto grid grid-cols-3 gap-4">
            <article class="saldo bg-blue-600 dark:bg-transparent dark:border-blue-600 dark:border dark:text-gray-300 p-4 text-white rounded-lg">
                <livewire:valores.saldo periodo="todo" />
                <span class="border-t border-white/50 w-full block mt-4"></span>
                <p class="mt-2 text-sm font-light ">Conta corrente</p>
            </article>

            <article class="receita p-4 bg-green-600 dark:bg-transparent dark:border-green-600 dark:border rounded-lg">
                <livewire:valores.receita periodo="todo"/>
                <span class="px-4 border-t border-white/50 w-full block mt-4"></span>
            </article>

            <article class="despesa rounded-lg p-4 receita bg-red-600 dark:bg-transparent dark:border-red-600 dark:border">
                <livewire:valores.despesa periodo="todo"/>
                <span class="px-4 border-t border-white/50 w-full block mt-4"></span>
            </article>
        </div>

        <div class="lista">
            <livewire:transacao.listar /> 
        </div>
    </section>
</x-app-layout>
