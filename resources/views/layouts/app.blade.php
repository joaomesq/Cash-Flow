<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" src="{{asset('img/LOGO-CHANAX-BLUE.png')}}" type="image/x-icon">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Page Heading -->
        <header class="hidden lg:block bg-white dark:bg-gray-800 shadow">
            <div>
                @include('layouts.welcome')
            </div>
        </header>

        <!-- Lateral Bar -->
        <aside class="hidden lg:block">
            <section class="m-8 barra-lateral fixed left-0 bg-white dark:bg-gray-800 h-[80%] w-[180px] shadow-lg rounded-lg">
                <!-- Logo -->
                <div class="shrink-0 border-b dark:border-gray-500 border-b-2 py-2">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-16 w-20 fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="nav">
                    <nav>
                        <ul class="p-4 grid h-full max-w-lg mx-auto">
                            <li class="my-2">
                                <a href="{{ route('home')}}" class="flex items-center gap-2 group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-home w-8 h-6 text-slate-400 group-hover:text-blue-600 transition-colors"
                                    >
                                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                        <polyline points="9 22 9 12 15 12 15 22" />
                                    </svg>

                                    <span class="text-lg font-bold text-slate-400 group-hover:text-blue-600">Início</span>
                                </a>
                            </li>
                            <li class="my-4">
                                <a href="{{ route('transacao.create')}}" class="flex items-center gap-2 group">
                                    <button class="flex items-center justify-center gap-2 group">
                                        <div class="bg-transaparent text-gray-400 border-2 dark:border-gray-400 p-1 rounded-full  transition-transform group-hover:text-blue-600 group-hover:border-blue-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor"  stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6"
                                            >
                                              <path d="M5 12h14" />
                                              <path d="M12 5v14" />
                                            </svg>
                                        </div>
                                        <span class="text-lg font-bold text-slate-400 group-hover:text-blue-600">Novo</span>
                                    </button>
                                </a>
                            </li>
                            <li class="my-4">
                                <a href="{{ route('transacao.historico')}}" class="flex items-center gap-2 group">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-history w-8 h-6 text-slate-400 group-hover:text-blue-600 transition-colors"
                                    >
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                        <path d="M3 3v5h5" />
                                        <path d="M12 7v5l4 2" />
                                    </svg>
                                    <span class="text-lg font-bold text-slate-400 group-hover:text-blue-600">Histórico</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </section>
        </aside>

        <!-- Page Content -->
        <main class="py-4 pb-16 lg:ml-[250px]">
            {{ $slot }}
        </main>

        <footer class="bg-gray-100 dark:bg-gray-900 pt-1">
            <section class="p-4 fixed bottom-0  lg:hidden left-0 z-50 w-full h-16 bg-white/80 dark:bg-gray-800 shadow border-t border-slate-200 dark:border-0 backdrop-blur-lg pb-[env(safe-area-inset-bottom)]">
                <nav>
                    <ul class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                        <li>
                            <a href="{{ route('home')}}" class="flex flex-col items-center justify-center gap-1 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-home w-6 h-6 text-slate-400 group-hover:text-blue-600 transition-colors"
                                >
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>

                                <span class="text-[10px] font-medium text-slate-400 group-hover:text-blue-600">Início</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transacao.create')}}" class="flex flex-col items-center justify-center -mt-6 group">
                                <button>
                                    <div class="bg-blue-600 dark:bg-blue-500 p-3 rounded-full shadow-lg shadow-blue-200 dark:shadow-blue-900/30 group-active:scale-95 transition-transform border-4 border-white dark:border-slate-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-6 h-6"
                                        >
                                          <path d="M5 12h14" />
                                          <path d="M12 5v14" />
                                        </svg>
                                    </div>
                                    <span class="text-[10px] font-bold text-blue-600 mt-1 uppercase tracking-tighter">Novo</span>
                                </button>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transacao.historico')}}" class="flex flex-col items-center justify-center gap-1 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-history w-6 h-6 text-slate-400 group-hover:text-blue-600 transition-colors"
                                >
                                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                    <path d="M3 3v5h5" />
                                    <path d="M12 7v5l4 2" />
                                </svg>
                                <span class="text-[10px] font-medium text-slate-400 group-hover:text-blue-600">Histórico</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('profile.edit')}}" class="flex flex-col items-center justify-center gap-1 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-user-circle w-6 h-6 text-slate-400 group-hover:text-blue-600 transition-colors"
                                >

                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="10" r="3" />

                                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                </svg>
                                <span class="text-[10px] font-medium text-slate-400 group-hover:text-blue-600">Perfil</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>
        </footer>
    </div>
</body>

@livewireScripts

</html>