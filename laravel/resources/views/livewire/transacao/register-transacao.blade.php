<section class="insert-transacao p-4">
    <div>
        <form wire:key="form-{{ $formKey }}" wire:submit.prevent="salvar">
            <fieldset class="grid grid-cols-2 lg:grid-cols-5 lg:justify-items-center lg:items-center gap-4 dark:text-gray-300">
                <div>
                    <label>Descricao</label>
                    <input class="w-full rounded bg-transparent dark:bg-transparent" type="text" name="input-descricao" wire:model="descricao" placeholder="Descricação da transação" required>
                    @error('descricao')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Categoria</label>
                    <select class="w-full rounded bg-transparent dark:bg-transparent" wire:model="categoria" name="select-categoria">
                        <option value="">Selecione</option>
                        @foreach($categorias as $key => $value)
                            <option value="{{ $key }}" class="bg-transparent dark:bg-transparent">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Data</label>
                    <input class="w-full rounded bg-transparent dark:bg-transparent"  type="date" name="input-data" wire:model="data" required>
                    @error('data')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label>Valor</label>
                    <input type="text" class="w-full rounded bg-transparent dark:bg-transparent" name="input-valor" wire:model="valor" step="0.01" placeholder="Valor">
                    @error('valor')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center gap-12 lg:mt-4">
                    <p>
                        <input class="p-2" type="radio" name="input-tipo" wire:model="tipo" value="receita"><label>Entrada</label>
                    </p>

                    <p>
                        <input class="p-2" type="radio" name="input-tipo" wire:model="tipo" value="despesa"><label>Saída</label>
                    </p>
                    @error('tipo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </fieldset>

            <div class="text-end text-white mt-2 lg:mt-4">
                <button type="submit" class="bg-green-800 p-2 rounded">Adicionar</button>
            </div>
        </form>
    </div>
</section>
