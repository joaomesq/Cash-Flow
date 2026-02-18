<section class="dark:border md:py-6 dark:border-gray-600 bg-white dark:bg-transparent rounded-lg shadow p-4 w-full dark:text-gray-300">
    <div class="mb-2 lg:grid lg:grid-cols-[1fr_3fr] items-center gap-2">
        <div class="data text-end p-2 mb-4 lg:mb-0">
            <button wire:click="backMonth" class="lg border dark:border-gray-600 rounded w-[50px] h-[30px]"><</button>
            <label class="text-lg mx-2">{{ $data }}</label>
            <button class="lg border rounded w-[50px] dark:border-gray-600 h-[30px]" wire:click="nextMonth()">></button>
        </div>
        
        <div class="grid grid-cols-3 items-center px-4 lg:justify-items-center">
            <div class="receita">
                <p class="">Receita</p>
                <span class="text-green-600">AO {{ number_format($receita, 2, ',', '.') }}</span>
            </div>

            <div class="despesa">
                <p class="">Despesa</p>
                <span class="text-red-500">AO {{ number_format($despesa, 2, ',', '.') }}</span>
            </div>

            <div class="saldo">
                <p class="">Saldo</p>
                <span class="{{ ($saldo >= 0)? 'text-green-500': 'text-red-500' }}">AO {{ number_format($saldo, 2, ',', '.') }}</span>
            </div>
        </div>
    </div>
</section>
