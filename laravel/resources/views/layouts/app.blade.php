<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
    <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1"> 
         <meta name="csrf-token" content="{{ csrf_token() }}"> 
         <title>{{ config('app.name', 'Laravel') }}</title> 
         <!-- Fonts --> <link rel="preconnect" href="https://fonts.bunny.net"> 
         <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         
     
         <!-- Scripts --> @vite(['resources/css/app.css', 'resources/js/app.js']) 
          
          @livewireStyles 
           @livewireStyles
 @vite(['resources/css/custom.css', 'resources/js/custom.js'])
        @livewireStyles

       
        </head> 
         <body class="font-sans antialiased bg-[#fff] dark:bg-[#0f0f10]"> 
            <!-- NAV COMPLETA (SIDEBAR + TOPBAR) --> 
            @include('layouts.navigation') 
            <!-- CONTEÚDO DA PÁGINA --> 
<main class="ml-20 mt-16 px-6 py-6">
    {{ $slot }}
</main>
    
@livewireScripts 
</body> 
</html>