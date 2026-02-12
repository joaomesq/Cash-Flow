<section class="">
    <div class="table-receitas">
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($transacoes))
                    <tr>
                        <td>Sem registros</td>
                    </tr>
                @else
                    @foreach($transacoes as $transacao)
                         <tr>
                            <td>{{ $transacao->descricao }}</td>
                            <td>{{ $transacao->data }}</td>
                            <td class="{{ ($transacao->tipo != 'receita')? 'text-red-500': 'text-green-500' }}">AO {{ number_format($transacao->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>