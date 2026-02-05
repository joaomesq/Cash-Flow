<section>
    <div class="filtros border border-gray-600 rounded p-4 mb-2">
        <p>
            <label>Descrição</label>
            <input type="text" wire:model.live="descricao" placeholder="Descrição">
        </p>

        <p>
            <label>Categoria</label>
            <input type="text" wire:model.live="categoria" placeholder="Categoria">
        </p>

        <p>
            <label>Data Início</label>
            <input type="date" wire:model.live="dataInicio">
        </p>

        <p>
            <label>Data Fim</label>
            <input type="date" wire:model.live="dataFim">
        </p>

        <p>
            <label>Tipo</label>
            <select wire:model.live="tipo">
                <option value="">Selecione</option>
                @foreach($tipos as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </p>
        
        <p>
            <label>Valor</label>
            <input type="text" wire:model.live="valor" placeholder="Valor">
        </p>

        <p>
            <button wire:click="limparFiltros">Limpar Filtros</button>
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
