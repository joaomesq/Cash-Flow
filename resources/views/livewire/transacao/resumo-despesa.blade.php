<section class="p-2 overflow-x-auto  bg-white dark:bg-transparent border rounded-lg shadow-lg dark:border-gray-400">
    <!-- Cabeçalho e Filtros -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Despesasss</h2>
        
        <div class="flex space-x-2 text-sm">
            <button wire:click="alterarFiltro('categoria')" 
                    class="px-3 py-1 rounded-md transition-colors {{ $filtro === 'categoria' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                Categoria
            </button>
            <button wire:click="alterarFiltro('descricao')" 
                    class="px-3 py-1 rounded-md transition-colors {{ $filtro === 'descricao' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                Descrição
            </button>
        </div>
    </div>

    <table class="min-w-full border-t text-gray-900 dark:text-gray-200 divide-y divide-gray-200">
        <tbody class="divide-y divide-gray-200 dark:bg-gray-900 bg-white">
            @if(empty($despesas))
                <tr>
                    <td class="w-full">Não tem despesas registradas</td>
                </tr>
            @else
                @foreach($despesas as $despesa)
                    <tr class="hover:bg-gray-300 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{($filtro === "categoria")? $despesa->categoria: $despesa->descricao }}</td>
                        <td class="text-red-600 px-6 py-4 whitespace-nowrap capitalize">+ AO {{ number_format($despesa->total, 2, ',', '.')}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{ $despesas->links()}}
</section>