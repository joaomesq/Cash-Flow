<section>
    <div>
        <div class="data">
            <button wire:click="backMonth"><</button>
            <label>{{ $data }}</label>
            <button wire:click="nextMonth()">></button>
        </div>

        <div class="receita">
            <p>Receita</p>
            <span>AO {{ number_format($receita, 2, ',', '.') }}</span>
        </div>

        <div class="despesa">
            <p>Despesa</p>
            <span>AO {{ number_format($despesa, 2, ',', '.') }}</span>
        </div>

        <div class="saldo">
            <p>Saldo</p>
            <span>AO {{ number_format($saldo, 2, ',', '.') }}</span>
        </div>
    </div>
</section>
