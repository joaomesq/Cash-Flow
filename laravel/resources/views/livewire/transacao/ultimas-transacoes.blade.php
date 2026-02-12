<section class="p-2 overflow-x-auto  bg-white dark:bg-transparent border rounded-lg shadow-lg dark:border-gray-400">
    <h2 class="font-semibold text-lg dark:text-gray-200 mb-2">Transações Recentes</h2>
    <table class="min-w-full border-t text-gray-900 dark:text-gray-200 divide-y divide-gray-200">
        <tbody class="divide-y divide-gray-200 dark:bg-gray-900 bg-white">
            @if(empty($transacoes))
                <tr>
                    <td class="w-full">Registre a tua primeira transação</td>
                </tr>
            @else
                @foreach($transacoes as $transacao)
                    <tr class="hover:bg-gray-400">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->data }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $transacao->descricao }}</td>
                        <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }} px-6 py-4 whitespace-nowrap capitalize"><span>{{($transacao->tipo != 'receita')? '-': '+'}}</span> AO {{$transacao->valor }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    </div>
</section>