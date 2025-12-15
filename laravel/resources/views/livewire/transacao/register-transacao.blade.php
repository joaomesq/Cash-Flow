<section class="insert-transacao bg-white p-4">
    <div>
        <form wire:submit.prevent="salvar">
            <fieldset>
                <div>
                    <label>Descricao</label>
                    <input type="text" name="input-descricao" wire:model="descricao" placeholder="Descricação da transação" required>
                    @error('descricao')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Categoria</label>
                    <select wire:model.live="categoria" name="select-categoria">
                        <option value="">Selecione</option>
                        @foreach($categorias as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Data</label>
                    <input type="date" name="input-data" wire:model="data" required>
                    @error('data')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Valor</label>
                    <input type="text" name="input-valor" wire:model="valor" step="0.01">
                    @error('valor')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <p>
                        <input type="radio" name="input-tipo" wire:model="tipo" value="receita"><label>Entrada</label>
                    </p>

                    <p>
                        <input type="radio" name="input-tipo" wire:model="tipo" value="despesa"><label>Saída</label>
                    </p>
                    @error('tipo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <div>
                <button type="submit">Inserir</button>
            </div>
        </form>
    </div>

    {{ $descricao.$valor.$tipo.$categoria.$data }}
</section>
