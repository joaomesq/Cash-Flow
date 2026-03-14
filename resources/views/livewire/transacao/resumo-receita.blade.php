<section class="p-2 overflow-x-auto  bg-white dark:bg-transparent border rounded-lg shadow-lg dark:border-gray-400">
    <h2 class="font-semibold text-lg dark:text-gray-200 mb-2">Receitas</h2>
    <table class="min-w-full border-t text-gray-900 dark:text-gray-200 divide-y divide-gray-200">
        <tbody class="divide-y divide-gray-200 dark:bg-gray-900 bg-white">
            @if(empty($receitas))
                <tr>
                    <td class="w-full">Não tem receitas registradas</td>
                </tr>
            @else
                @foreach($receitas as $receita)
                    <tr class="hover:bg-gray-300 dark:hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $receita->categoria }}</td>
                        <td class="text-green-600 px-6 py-4 whitespace-nowrap capitalize">+ AO {{$receita->total }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</section>