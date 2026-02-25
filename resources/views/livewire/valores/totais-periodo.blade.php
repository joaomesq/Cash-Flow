<section>
    <div>
        <div class="periodo p-2">
            <button class="border p-2" wire:click="trocarPeriodo('back')"><</button>
            <h2>Periodo: {{ $periodo }}</h2>
            <button class="border p-2" wire:click="trocarPeriodo('next')">></button>
        </div>

        <div class="data p-2">
            <button wire:click="alterarData('back')" class="border p-2"><</button>
            <h2>Data: {{ $data }}</h2>
        <button class="border p-2" wire:click="alterarData('next')">></button>
        </div>
    </div>

    <div>
        <h2>Receita: <span class="text-green-500">AOA {{ number_format($receita, 2, ',', '.') }}</span></h2>
    </div>

    <div>
        <h2>Despesa: <span class="text-red-500">AOA {{ number_format($despesa, 2, ',', '.') }}</span></h2>
    </div>

    <div>
        <h2>Saldo: <span class="{{ ($saldo >= 0)? 'text-green-500': 'text-red-500' }}">AOA {{ number_format($saldo, 2, ',', '.') }}</span></h2>
    </div>
</section>
