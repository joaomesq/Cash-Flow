<section class="grid grid-cols-2">
    <div class="table-receitas">
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
                @if(empty($receitas))
                    <tr>
                        <td>Sem registros</td>
                    </tr>
                @else
                    @foreach($receitas as $receita)
                         <tr>
                            <td>{{ $receita->descricao }}</td>
                            <td>{{ $receita->categoria }}</td>
                            <td>{{ $receita->data }}</td>
                            <td class="text-green-500">AO {{ number_format($receita->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="table-despesas">
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
                @if(empty($despesas))
                    <tr>
                        <td>Sem registros</td>
                    </tr>
                @else
                    @foreach($despesas as $despesa)
                         <tr>
                            <td>{{ $despesa->descricao }}</td>
                            <td>{{ $despesa->categoria }}</td>
                            <td>{{ $despesa->data }}</td>
                            <td class="text-red-500">AO {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>