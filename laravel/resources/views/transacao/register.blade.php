<x-app-layout>
    <section class="main p-4">
        <div class="w-full container mb-4">
            <livewire:transacao.resumo-mensal />
        </div>

        <div class="w-full shadow rounded-lg bg-white dark:text-gray-300 p-4 md:py-6 mx-auto container mb-4">
            <livewire:transacao.register-transacao />
        </div>

        <div class="w-full shadow rounded-lg bg-white dark:text-gray-300 p-4 md:py-6 mx-auto container">
            <livewire:transacao.lista-mensal />
        </div>
    </section>
</x-app-layout>
