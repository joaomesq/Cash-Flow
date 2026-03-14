<section class="p-2 overflow-x-auto  bg-white dark:bg-transparent border rounded-lg shadow-lg dark:border-gray-400">
    <!-- Cabeçalho e Filtros -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Receitas</h2>
        
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
            @if(empty($receitas))
                <tr>
                    <td class="w-full">Não tem receitas registradas</td>
                </tr>
            @else
                @foreach($receitas as $receita)
                    <tr class="hover:bg-gray-300 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{($filtro === "categoria")? $receita->categoria: $receita->descricao }}</td>
                        <td class="text-green-600 px-6 py-4 whitespace-nowrap capitalize">+ AO {{ number_format($receita->total, 2, ',', '.')}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</section>