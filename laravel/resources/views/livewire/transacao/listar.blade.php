<section>
    <table>
        <thead>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Data</th>
            <th>Valor</th>
            <th></th>
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
                       <td class="{{ ($transacao->tipo == 'receita')? 'text-green-500': 'text-red-500' }}">{{ number_format($transacao->valor, 2, ',', '.') }}</td>
                    </tr>
               @endforeach
            @endif
        </tbody>
    </table>
    {{ $transacoes->links() }}
</section>
