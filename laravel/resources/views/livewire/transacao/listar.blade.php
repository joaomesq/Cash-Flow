<section>
    <div class="filtros border border-gray-600 rounded p-4 mb-2">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center dark:text-gray-300 justify-items-center">
            <p class="w-full">
                <label>Descrição</label>
                <input class="w-full dark:bg-transparent rounded dark:text-gray-200" type="text" wire:model.live="descricao" placeholder="Descrição">
            </p>

            <p class="w-full">
                <label>Categoria</label>
                <input class="w-full dark:bg-transparent rounded dark:text-gray-200" type="text" wire:model.live="categoria" placeholder="Categoria">
            </p> 

            <p class="w-full">
                <label>Data Início</label>
                <input class="w-full dark:bg-transparent rounded dark:text-gray-200" type="date" wire:model.live="dataInicio">
            </p>

            <p class="w-full">
                <label>Data Fim</label>
                <input class="w-full dark:bg-transparent rounded dark:text-gray-200" type="date" wire:model.live="dataFim">
            </p>

            <p class="w-full">
                <label>Tipo</label>
                <select class="w-full dark:bg-transparent rounded dark:text-gray-200" wire:model.live="tipo">
                    <option value="">Selecione</option>
                    @foreach($tipos as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </p>
        
            <p class="w-full">
                <label>Valor</label>
                <input class="w-full dark:bg-transparent rounded dark:text-gray-200" type="text" wire:model.live="valor" placeholder="Valor">
            </p>
        </div>

        <p class="text-end mt-4">
            <button class="uppercase bg-blue-500 text-white p-2 rounded" wire:click="limparFiltros">Limpar Filtros</button>
        </p>
    </div>

    <div class="border border-gray-600 rounded p-4 overflow-x-auto">
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
    </div>
</section>
