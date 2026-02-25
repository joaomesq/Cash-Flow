<section class="grid grid-cols-2">
    <div class="recitas">
        <table>
            <thead>
                <tr>
                    <th>Descrição/Categoria</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($receitas) || $receitas == False)
                   <tr>
                       <td>Vazio</td>
                   </tr>
                @else
                   @foreach($receitas as $receita)
                       <tr>
                            <td>{{ $receita->descricao }}</td>
                            <td class="text-green-500">{{ $receita->total }}</td>
                       </tr>
                   @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="despesa">
        <table>
            <thead>
                <tr>
                    <th>Descrição/Categoria</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($despesas))
                   <tr>
                       <td>Vazio</td>
                   </tr>
                @else
                   @foreach($despesas as $despesa)
                       <tr>
                            <td>{{ $despesa->descricao }}</td>
                            <td class="text-red-500">{{ $despesa->total }}</td>
                       </tr>
                   @endforeach
                @endif
            </tbody>
        </table>
    </div>
</section>
