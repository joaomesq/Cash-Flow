<section>
    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @if(empty($transacoes))
                <tr>
                    <td class="w-100">Registre a tua primeira transação</td>
                </tr>
            @else
                @foreach($transacoes as $transacao)
                    <tr>
                        <td>{{ $transacao->descricao }}</td>
                        <td>{{ $transacao->categoria }}</td>
                        <td>{{ $transacao->data }}</td>
                        <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }}">AO {{ $transacao->valor }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</section>
