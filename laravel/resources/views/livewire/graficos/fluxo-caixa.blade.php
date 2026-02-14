<div class="p-4 bg-white dark:bg-gray-800 border rounded-lg shadow-lg dark:border-gray-700">
    <!-- Cabeçalho e Filtros -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200">Fluxo de Caixa</h2>
        
        <div class="flex space-x-2 text-sm">
            <button wire:click="setPeriodo('semanal')" 
                    class="px-3 py-1 rounded-md transition-colors {{ $periodo === 'semanal' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                Semanal
            </button>
            <button wire:click="setPeriodo('mensal')" 
                    class="px-3 py-1 rounded-md transition-colors {{ $periodo === 'mensal' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                Mensal
            </button>
            <button wire:click="setPeriodo('todo')" 
                    class="px-3 py-1 rounded-md transition-colors {{ $periodo === 'todo' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300' }}">
                Todo
            </button>
        </div>
    </div>

    <!-- Área do Gráfico -->
    <div class="relative h-64 w-full"
         x-data='fluxoCaixaChart({
             labels: @json($labels),
             receitas: @json($receitas),
             despesas: @json($despesas)
         })'
    >
        <canvas x-ref="canvas"></canvas>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fluxoCaixaChart', (data) => ({
            chart: null,
            labels: data.labels,
            receitas: data.receitas,
            despesas: data.despesas,
            init() {
                this.renderChart();
            },
            renderChart() {
                const canvas = this.$refs.canvas;
                if (!canvas) return;

                // Destruir gráfico anterior se existir (importante para evitar erro "Canvas is already in use")
                const existingChart = Chart.getChart(canvas);
                if (existingChart) {
                    existingChart.destroy();
                }

                if (this.chart) {
                    this.chart.destroy();
                }

                const ctx = canvas.getContext('2d');

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.labels,
                        datasets: [
                            {
                                label: 'Receitas',
                                data: this.receitas,
                                backgroundColor: 'rgba(34, 197, 94, 0.6)',
                                borderColor: 'rgba(34, 197, 94, 1)',
                                borderWidth: 1,
                                borderRadius: 4
                            },
                            {
                                label: 'Despesas',
                                data: this.despesas,
                                backgroundColor: 'rgba(239, 68, 68, 0.6)',
                                borderColor: 'rgba(239, 68, 68, 1)',
                                borderWidth: 1,
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(156, 163, 175, 0.1)'
                                },
                                ticks: {
                                    color: '#9CA3AF'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#9CA3AF'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#9CA3AF'
                                }
                            }
                        }
                    }
                });
            }
        }));
    });
</script>
