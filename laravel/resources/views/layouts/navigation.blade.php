@vite(['resources/css/nav.css'])
@livewireStyles

<nav x-data="{ open: false }" class="flex min-h-screen bg-gray-100 dark:bg-[#0f0f10]">
    <!-- Primary Navigation Menu -->
    <div class="flex w-full">
        
        <!-- SIDEBAR -->
        <aside
            class="w-20 bg-[#f2f2f2] dark:bg-[#151517] border-r dark:border-gray-800
                   flex flex-col items-center py-6 gap-6 fixed inset-y-0 z-40"
        >
            <!-- Logo -->
            <div class="shrink-0 flex items-center text-xl font-extrabold tracking-wide
                        text-gray-800 dark:text-white">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo
                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                    />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col gap-4 p-3">
                <a
                    href="{{ route('dashboard') }}"
                    class="w-10 h-10 rounded-xl bg-[#007fff]
                           flex items-center justify-center text-white shadow"
                >
                    ▦
                </a>

                <a
                    href="{{ route('transacao.create') }}"
                    class="w-10 h-10 rounded-xl bg-[#ccc] dark:bg-[222222]
                           flex items-center justify-center"
                >
                    📊
                </a>

                <button class="w-10 h-10 rounded-xl bg-[#ccc] dark:bg-[222222]">
                    💬
                </button>

                <button class="w-10 h-10 rounded-xl bg-[#ccc] dark:bg-[222222]">
                    👥
                </button>
            </div>

            <!-- Settings / Bottom Actions -->
            <div class="mt-auto border-t flex flex-col items-center gap-4 w-full">
                
                <!-- Profile -->
                <a
                    href="{{ route('profile.edit') }}"
                    class="w-10 h-10 rounded-xl bg-[#ccc] dark:bg-[222222]
                           flex items-center justify-center"
                >
                    ⚙️
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-10 h-10 rounded-xl bg-[#ccc] dark:bg-[222222]
                               flex items-center justify-center"
                    >
                        ⏻
                    </button>
                </form>

                <!-- Theme Switch -->
                <div class="flex justify-center w-full">
                    <button
                        onclick="toggleTheme()"
                        class="relative w-20 h-10 rounded-full bg-gray-800
                               dark:bg-gray-800 transition-colors duration-800"
                    >
                        <!-- Switch Background -->
                        <span
                            id="switchBg"
                            class="absolute top-1 left-1 w-8 h-8 rounded-full
                                   bg-[#0d6edf] transition-transform duration-300"
                        ></span>

                        <!-- Icons -->
                        <div
                            class="relative z-10 flex items-center justify-between
                                   h-full px-3 modo rounded-full"
                        >
                            <!-- Sun -->
                            <svg
                                id="sunIcon"
                                class="w-5 h-5 text-white dark:text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <circle cx="12" cy="12" r="4" />
                                <path
                                    d="M12 2v2M12 20v2
                                       M4.93 4.93l1.41 1.41
                                       M17.66 17.66l1.41 1.41
                                       M2 12h2M20 12h2
                                       M4.93 19.07l1.41-1.41
                                       M17.66 6.34l1.41-1.41"
                                />
                            </svg>

                            <!-- Moon -->
                            <svg
                                id="moonIcon"
                                class="w-5 h-5 text-gray-400 dark:text-white"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M21.752 15.002A9 9 0 1112 3
                                       a7 7 0 009.752 12.002z"
                                />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>
        </aside>

        <!-- TOP BAR -->
        <div class="flex-1 ml-20">
          <header
    class="fixed top-0 left-20 right-0 h-16
           bg-[#ffffff] dark:bg-[#222222]
           flex items-center justify-between px-8 z-30"
>

                <!-- Search -->
                <input
                    type="text"
                    placeholder="Pesquisar"
                    class="px-4 py-2 rounded-full bg-gray-100 pesquisa
                           dark:bg-[#151517] text-sm w-72"
                />

                <!-- Right Side -->
                <div class="flex items-center gap-4">
                    <div
                        class="px-4 py-2 bg-gray-100 dark:bg-[#151517]
                               dark:text-[#808080] rounded-full text-sm"
                    >
                        09-12-2025 / 15-12-2025
                    </div>

                    <div
                        class="w-9 h-9 bg-black dark:bg-[#151517]
                               dark:text-[#808080] rounded-full"
                    ></div>

                    <div
                        class="px-4 py-2 bg-black dark:bg-[#151517]
                               dark:text-[#808080] text-white
                               rounded-full text-sm"
                    >
                        Olá, {{ Auth::user()->name }}
                    </div>
                </div>
            </header>
        </div>
    </div>
</nav>
