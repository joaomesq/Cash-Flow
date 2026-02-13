<div class="p-2 overflow-x-auto  bg-white dark:bg-transparent border rounded-lg shadow-lg dark:border-gray-400">
    <h2 class="font-semibold text-lg dark:text-gray-300">Fluxo de Caixa</h2>
    
    @foreach ($dados as $item)
        <p>{{ $item }}</p>
    @endforeach
</div>
