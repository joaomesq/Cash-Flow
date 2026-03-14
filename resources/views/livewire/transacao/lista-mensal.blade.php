<section class="p-4 overflow-x-auto bg-white dark:bg-transparent dark:border dark:border-gray-600 rounded-lg">
    <table class="min-w-full text-gray-900 dark:text-gray-200 divide-y divide-gray-200">
        <thead class="bg-gray-100 uppercase text-gray-600 dark:text-gray-300 dark:bg-gray-600 sticky top-0 z-10">
            <tr>
                <th class="px-6  py-4 text-left text-xs  tracking-wider">Descrição</th>
                <th class="px-6  py-4 text-left text-xs  tracking-wider">Categoria</th>
                <th class="px-6  py-4 text-left text-xs  tracking-wider">Data</th>
                <th class="px-6  py-4 text-left text-xs  tracking-wider">Valor</th>
                <th class="px-6  py-4 text-left text-xs tracking-wider"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:bg-gray-900 bg-white">
            @if(empty($transacoes))
                <tr>
                    <td class="w-full">Registre a tua primeira transação</td>
                </tr>
            @else
                @foreach($transacoes as $transacao)
                    <tr class="hover:bg-gray-300 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->descricao }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->categoria }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->data }}</td>
                        <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }} px-6 py-4 whitespace-nowrap capitalize">AO {{ number_format($transacao->valor, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">
                            <livewire:transacao.delete-transacao :id="$transacao->id" wire:key="delelte-item-{{$transacao->id}}"/>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $transacoes->links() }}
</section>
