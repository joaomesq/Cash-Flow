<!-- Logo na sidebar -->
<div class="text-center">
    <!-- Modo claro -->
    <a href="{{ route('dashboard') }}" class="block dark:hidden">
        <img src="{{ asset('img/LOGO-CHANAX-BLACK.png') }}" 
             alt="Logo Claro" 
             class="w-24 h-34 mx-auto">
    </a>

    <!-- Modo escuro -->
    <a href="{{ route('dashboard') }}" class="hidden dark:block">
        <img src="{{ asset('img/LOGO-CHANAX-WHITE.png') }}" 
             alt="Logo Escuro" 
             class="w-24 h-34 mx-auto">
    </a>
</div>