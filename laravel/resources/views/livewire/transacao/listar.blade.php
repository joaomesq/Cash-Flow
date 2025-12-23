<section>
    <div class="filtros">
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

    <div>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(empty($transacoes))
                    <tr>
                        <td>Comece a controlar as tuas finanças agora, faça o registro dos teus movimentos</td>
                    </tr>
                @else
                   @foreach($transacoes as $transacao)
                        <tr>
                            <td>{{ $transacao->descricao }}</td>
                            <td>{{ $transacao->categoria }}</td>
                            <td>{{ $transacao->data }}</td>
                            <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }}">AO {{ number_format($transacao->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $transacoes->links() }}
    </div>
</section>
