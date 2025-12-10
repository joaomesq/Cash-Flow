<section class="insert-transacao bg-white p-4">
    <div>
        <form wire:submit.prevent="salvar">
            <fieldset>
                <div>
                    <label>Descricao</label>
                    <input type="text" name="input-descricao" wire:model="descricao" placeholder="Descricação da transação" required>
                </div>

                <div>
                    <label>Categoria</label>
                    <select wire:model="categoria" name="select-categoria">
                        <option value="venda">Venda</option>
                        <option value="compra">Compra</option>
                        <option value="recebimento">Recebimento</option>
                        <option value="pagamento">Pagamento</option>
                        <option value="investimento">Investimento</option>
                        <option value="prestação de serviço">Prestação de Serviço</option>
                        <option value="despesas fixas">Despesas Fixas</option>
                        <option value="despesas variáveis">Despesas Variáveis</option>
                        <option value="gastos não essenciais">Gastos não essenciais</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>

                <div>
                    <label>Data</label>
                    <input type="date" name="input-data" wire:model="data" required>
                </div>

                <div>
                    <label>Valor</label>
                    <input type="text" name="input-valor" wire:model="valor" value="0" required>
                </div>

                <div>
                    <p>
                        <input type="radio" name="input-tipo" wire:model="tipo" value="entrada" checked><label>Entrada</label>
                    </p>

                    <p>
                        <input type="radio" name="input-tipo" wire:model="tipo" value="saida"><label>Saída</label>
                    </p>
                </div>
            </fieldset>

            <div>
                <button type="submit">Inserir</button>
            </div>
        </form>
    </div>
</section>
