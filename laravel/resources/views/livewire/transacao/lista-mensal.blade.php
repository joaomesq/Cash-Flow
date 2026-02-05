<section class="p-2 overflow-x-auto">
    <table class="min-w-full text-gray-900 dark:text-gray-200 divide-y divide-gray-200">
        <thead class="bg-gray-50 uppercase text-gray-400 dark:bg-gray-800 sticky top-0 z-10">
            <tr>
                <th class="px-6  py-3 text-left text-xs  tracking-wider">Descrição</th>
                <th class="px-6  py-3 text-left text-xs  tracking-wider">Categoria</th>
                <th class="px-6  py-3 text-left text-xs  tracking-wider">Data</th>
                <th class="px-6  py-3 text-left text-xs  tracking-wider">Valor</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:bg-gray-900 bg-white">
            @if(empty($transacoes))
                <tr>
                    <td class="w-full">Registre a tua primeira transação</td>
                </tr>
            @else
                @foreach($transacoes as $transacao)
                    <tr class="hover:bg-gray-200 hover:text-black">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->descricao }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->categoria }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->data }}</td>
                        <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }} px-6 py-4 whitespace-nowrap capitalize">AO {{ $transacao->valor }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $transacoes->links() }}
</section>
