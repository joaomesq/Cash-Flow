<x-app-layout>
    <section class="main p-4">
        <div class="w-full border border-gray-800 rounded shadow py-2">
            <livewire:transacao.resumo-mensal />
        </div>

        <div class="w-full border border-gray-800 rounded mt-4">
            <livewire:transacao.register-transacao />
        </div>

        <div class="bg-white mt-4">
            <livewire:transacao.lista-mensal />
        </div>
    </section>
</x-app-layout>
