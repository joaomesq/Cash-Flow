<section>
    <div>
        <div class="data">
            <button wire:click="backMonth"><</button>
            <label>{{ $data }}</label>
            <button wire:click="nextMonth()">></button>
        </div>

        <div class="receita">
            <p>Receita</p>
            <span>AO {{ $receita }}</span>
        </div>

        <div class="despesa">
            <p>Despesa</p>
            <span>AO {{ $despesa }}</span>
        </div>
    </div>
</section>
