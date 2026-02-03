<section>
    <div class="mb-2 lg:grid lg:grid-cols-[1fr_3fr] items-center gap-2 text-gray-300">
        <div class="data text-end p-2 mb-4 lg:mb-0">
            <button wire:click="backMonth" class="lg border px-2 rounded w-[50px]"><</button>
            <label class="text-lg font-semibold mx-2">{{ $data }}</label>
            <button class="lg border px-2 rounded w-[50px]" wire:click="nextMonth()">></button>
        </div>
        
        <div class="grid grid-cols-3 items-center px-4 lg:justify-items-center">
            <div class="receita">
                <p class="text-lg">Receita</p>
                <span class="text-green-600">AO {{ number_format($receita, 2, ',', '.') }}</span>
            </div>

            <div class="despesa">
                <p class="text-lg">Despesa</p>
                <span class="text-red-500">AO {{ number_format($despesa, 2, ',', '.') }}</span>
            </div>

            <div class="saldo">
                <p class="text-lg">Saldo</p>
                <span class="{{ ($saldo >= 0)? 'text-green-500': 'text-red-500' }}">AO {{ number_format($saldo, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</section>
