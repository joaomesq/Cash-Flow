<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

         @vite(['resources/css/custom.css'])

        @livewireStyles
         





        
    </head>

    <body class="font-sans antialiased  dark:bg-[#222222]">
        <div class="min-h-screen bg-gray-100 dark:bg-[#222222]">

            <!-- Navigation / Sidebar -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-[#222222] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

        </div>

        @livewireScripts
    </body>

    <script>
document.addEventListener('DOMContentLoaded', () => {

    const switchBg = document.getElementById('switchBg');

    function setTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            switchBg.style.transform = 'translateX(40px)';
        } else {
            document.documentElement.classList.remove('dark');
            switchBg.style.transform = 'translateX(0)';
        }
    }

    window.toggleTheme = function () {
        const isDark = document.documentElement.classList.contains('dark');
        const newTheme = isDark ? 'light' : 'dark';

        localStorage.setItem('theme', newTheme);
        setTheme(newTheme);
    }

    // 🔥 AO CARREGAR A PÁGINA
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        setTheme(savedTheme);
    } else {
        // opcional: seguir sistema
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        setTheme(prefersDark ? 'dark' : 'light');
    }

});
</script>
<script>
if (!window.__themeInitialized) {
    window.__themeInitialized = true;

    document.addEventListener('DOMContentLoaded', () => {

        const switchBg = document.getElementById('switchBg');
        if (!switchBg) return;

        function setTheme(theme) {
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                switchBg.style.transform = 'translateX(40px)';
            } else {
                document.documentElement.classList.remove('dark');
                switchBg.style.transform = 'translateX(0)';
            }
        }

        window.toggleTheme = function () {
            const isDark = document.documentElement.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';

            localStorage.setItem('theme', newTheme);
            setTheme(newTheme);
        };

        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
    });
}
</script>


</html>
