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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="mt-6 pb-[80px]">
                {{ $slot }}
            </main>

            <footer class="bg-gray-100 dark:bg-gray-900 pt-1">
                    <section class="tab-bar dark:text-gray-300 lg:hidden text-gray-500 mt-8 fixed bottom-0 left-0 right-0 bg-white mt-6 p-4 shadow dark:bg-gray-800">
                        <nav>
                            <ul class="grid text-center font-bold grid-cols-4 gap-4 w-full container mx-auto uppercase">
                                <li>
                                    <a href="{{route('home')}}">Home</a>
                                </li>
                                <li>
                                    <a href="{{route('transacao.create')}}">Adicionar</a>
                                </li>
                                <li>
                                    <a href="{{route('transacao.historico')}}">Transações</a>
                                </li>
                                <li>
                                    <a href="{{route('profile.edit')}}">{{__('Perfil')}}</a>
                                </li>
                            </ul>
                        </nav>
                    </section>
            </footer>
        </div>
    </body>

    @livewireScripts
</html>
