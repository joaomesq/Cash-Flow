 

 @vite(['resources/css/dashboard.css', 'resources/js/dashboard.js'])
        @livewireStyles
 @vite(['resources/css/custom.css', 'resources/js/custom.js'])
        @livewireStyles
         


<x-app-layout>
    <!-- Dashboard Financeiro -->
    <section class="pt-6 pb-12 bg-[#fff] dark:bg-[#222222] main min-h-screen">
        <div class="max-w-9xl mx-auto ">

            <!-- HEADER -->
            <h2 class="text-gray-500 dark:text-gray-400 mb-2">Acompanhe suas receitas e despesas com precisão.</h2>
            <h1 class="text-4xl font-bold mb-0 text-gray-900 dark:text-gray-100 aaa">Dashboard Financeiro</h1>

            <!-- STATS -->
           <!-- Grid das cards do topo -->
<div class="grid  grid-cols-1 md:grid-cols-5 gap-6 flex-1">
    <!-- Total -->
    <div class="bg-white border dark:bg-gray-800 rounded-2xl p-8 shadow ">
        <p class="text-sm text-black dark:text-[#fff] mb-2">Total</p>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
            AO 2 495 472,00
        </h3>
    </div>

    <!-- Receitas -->
    <div class="bg-white border dark:bg-gray-800 rounded-2xl p-6 shadow">
        <p class="text-sm text-[#000] dark:text-[#fff] mb-2">Receitas</p>
        <h3 class="text-xl font-bold text-[#000] dark:text-[#fff]">AO 2 345 472</h3>
    </div>

    <!-- Despesas -->
    <div class="bg-white border  dark:bg-gray-800 rounded-2xl p-6 shadow">
        <p class="text-sm text-[#000] dark:text-[#fff] mb-2">Despesas</p>
        <h3 class="text-xl font-bold text-[#000] dark:text-[#fff]">AO 150 000</h3>
    </div>

   <!-- Coluna com Exportar PDF e + -->
<div class="flex flex-col justify-end">
    <!-- Botão Exportar PDF: ocupa a altura restante até a card Mensal -->
    <button class="bg-green-600 
   dark:bg-[#151517] dark:text-[#808080] hover:bg-green-700 transition text-white rounded-2xl flex-1 mb-5 shadow text-sm flex items-center justify-center pdf">
        Exportar PDF
    </button>

    <!-- Botão +: altura original -->
    <button class="bg-blue-600 hover:bg-blue-700 transition text-white rounded-2xl flex items-center justify-center text-3xl shadow mais">
        +
        
    </button>
</div>


    <!-- Mensal -->
    <div class="bg-white dark:bg-[#151517] rounded-2xl p-6 shadow">
        <p class="font-semibold mb-4 text-gray-900 dark:text-white"></p>
        <div class="flex gap-3 items-end h-24">
            <div class="w-6 h-24 bg-blue-600 rounded"></div>
            <div class="w-6 h-16 bg-gray-300 dark:bg-gray-600 rounded"></div>
            <div class="w-6 h-12 bg-gray-200 dark:bg-gray-500 rounded"></div>
        </div>
    </div>
</div>

            <!-- MIDDLE -->
         <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-2">

<!-- Relatório -->

<div class="bg-white dark:bg-[#151517] rounded-2xl p-6 shadow md:col-span-1">

  <h3 class="font-semibold mb-4 text-gray-900 dark:text-white">Relatório</h3>

  <div class="flex items-center mb-4">
    <!-- Legenda à esquerda (não vai exibir percentual aqui) -->
    <div class="flex flex-col mr-6">
      <div class="flex items-center mb-1">
        <span class="w-4 h-4 bg-blue-600 rounded-full mr-2"></span>
        <span class="text-sm text-gray-700 dark:text-gray-200 ">Receitas</span>
      </div>
      <div class="flex items-center mb-1">
        <span class="w-4 h-4 bg-pink-500 rounded-full mr-2"></span>
        <span class="text-sm text-gray-700 dark:text-gray-200">Despesas</span>
      </div>
      <div class="flex items-center">
        <span class="w-4 h-4 bg-gray-300 dark:bg-gray-600 rounded-full mr-2"></span>
        <span class="text-sm text-gray-700 dark:text-gray-200">Vazio</span>
      </div>
    </div>

    <!-- Gráfico central -->
    <div class="relative flex justify-center flex-1 w-30 h-30 dark:bg-[#151517]">
      <svg id="grafico" viewBox="0 0 100 100" class="w-25 h-25 ">
        <g id="segments"></g>
        <!-- Círculo central -->
       <circle
  id="central"
  cx="50"
  cy="48"
  r="35"
  class="fill-[#f2f2f2] dark:fill-[#151517]"
/>

        <text id="percentual" x="50" y="48" text-anchor="middle" dominant-baseline="middle" class="font-bold fill-gray-900 dark:fill-white ">0%</text>
        <!-- Percentual externo -->
        <text id="percentual-externo" x="50" y="50" text-anchor="middle" dominant-baseline="middle" class="font-bold fill-gray-900 dark:fill-white opacity-0 transition-opacity duration-200"></text>
      </svg>
    </div>
  </div>
  <button class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-full">Ver Relatório →</button>
</div>
                  
            

                
                <!-- Insights -->
<div class="bg-white dark:bg-[#151517] rounded-2xl p-6 shadow md:col-span-2">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-0">Insights</h3>
                        <select class="px-3 py-1 rounded-full bg-gray-100 dark:bg-[#151517] text-sm">
                            <option>Semanal</option>
                        </select>
                    </div>
                    <p class="text-sm text-gray-500 mb-6 text-left">Sua empresa teve <br> um aumento de <br> 10% nas vendas desta semana</p>
                    <div class="flex justify-between items-end h-32">
                        <div class="w-3 h-12 bg-gray-800 dark:bg-gray-400 rounded"></div>
                        <div class="w-3 h-20 bg-gray-800 dark:bg-gray-400 rounded"></div>
                        <div class="w-3 h-16 bg-gray-800 dark:bg-gray-400 rounded"></div>
                        <div class="w-3 h-24 bg-gray-800 dark:bg-gray-400 rounded"></div>
                        <div class="w-3 h-28 bg-blue-600 rounded"></div>
                        <div class="w-3 h-24 bg-gray-800 dark:bg-gray-400 rounded"></div>
                        <div class="w-3 h-16 bg-gray-800 dark:bg-gray-400 rounded"></div>
                    </div>
                </div>

                <!-- Destaque -->
               <!-- Destaque -->
<div class="bg-gradient-to-br from-blue-500 to-blue-300 rounded-2xl p-6 text-white shadow md:col-span-1">

                    <h3 class="text-2xl font-bold mb-2 cuide">Cuide melhor do seu dinheiro</h3>
                    <p>Este é o dashboard que vai lhe ajudar a fazer o controle do seu dinheiro.</p>
                </div>
            </div>

            <!-- BOTTOM -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Progresso -->
                <div class="bg-white dark:bg-[#151517] rounded-2xl p-6 shadow md:col-span-4">
                    <h3 class="font-semibold mb-4 text-gray-900 dark:text-white">Estado de progresso</h3>
                    <div class="w-full bg-gray-200 dark:bg-[#151517] rounded-full h-3 mb-2">
                        <div class="bg-blue-600 h-3 rounded-full w-1/2"></div>
                    </div>
                    <p class="text-sm text-gray-500 mb-4">Estimativa de progresso em 4–5 dias</p>
                    <button class="bg-black hover:bg-gray-900 transition text-white w-full py-2 rounded-full">Ver análise →</button>
                </div>

                <!-- Transações -->
                <div class="bg-white dark:bg-[#151517] rounded-2xl p-6 shadow md:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Transações</h3>
                        <span class="text-sm text-gray-500">Todas</span>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="text-left text-gray-400 thead dark:text-[#ccc] justify-end">
                            <tr class="">
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Montante</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y dark:text-[#ccc]">
                            <tr class="mb-5">
                                <td>1</td>
                                <td>Recebido</td>
                                <td>09/12/2026</td>
                                <td class="  text-green-600">AO 100 000</td>
                                <td><span class="bg-green-100 text-white 
                                dark:bg-green-600 px-3 py-1 
                                mb-5 rounded-full">Receitas</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Lazer</td>
                                <td>03/11/2026</td>
                                <td class="text-red-600">AO -8 300</td>
                                <td><span class="bg-red-100 text-red-600 px-3 py-1 rounded-full">Despesas</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>