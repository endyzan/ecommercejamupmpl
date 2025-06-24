<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<div class="grid grid-cols-1 my-4 xl:grid-cols-2 xl:gap-4">
    <!-- KATEGORI DONUT -->
    <div
        class="max-h-[70vh] p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="items-center justify-between pb-4 border-b border-gray-200 sm:flex dark:border-gray-700">
            <div class="w-full mb-4 sm:mb-0">
                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Distribusi Data</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Kategori</span>
            </div>
        </div>
        <canvas id="kategoriChart" class="max-h-[40vh] text-black dark:text-white" width="100" height="100"></canvas>

        {{-- Ringkasan Kategori --}}
        <div class="mt-4 text-sm text-gray-700 dark:text-gray-300">
            <p><strong>Total Unit Terjual:</strong> {{ $totalUnits }}</p>
            @php
                $categoryArray = $categoryData->toArray();
                $maxKategori = '-';
                $maxJumlah = 0;

                if (!empty($categoryArray)) {
                    $maxJumlah = max($categoryArray);
                    $keys = array_keys($categoryArray, $maxJumlah);
                    $maxKategori = $keys[0] ?? '-';
                }
            @endphp

            <p><strong>Kategori Terlaris:</strong> {{ $maxKategori }} ({{ $maxJumlah }} unit)</p>

        </div>
    </div>

    {{-- JAMU STATISTIK --}}
    @php
        $top_jamu_labels = collect($top_jamu)->pluck('nama_jamu')->toArray();
        $top_jamu_data = collect($top_jamu)->pluck('total_terjual')->toArray();
    @endphp

    @if (count($top_jamu_labels) > 0 && array_sum($top_jamu_data) > 0)
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Statistik Penjualan</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Produk Jamu</span>
                </div>
            </div>
            <canvas id="topJamuChart" class="max-h-[40vh] text-black dark:text-white" height="250"></canvas>

            {{-- Ringkasan Jamu --}}
            <div class="mt-4 text-sm text-gray-700 dark:text-gray-300">
                <p><strong>Total Penjualan:</strong>{{ rupiah($tabel_transaksi->sum('total_transaksi')) }}</p>
                <p><strong>Produk Terlaris:</strong> {{ $top_jamu[0]['nama_jamu'] ?? '-' }} ({{ $top_jamu[0]['total_terjual'] ?? 0 }} unit)</p>
            </div>

            <script>
                const ctxTopJamu = document.getElementById('topJamuChart').getContext('2d');
                new Chart(ctxTopJamu, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($top_jamu_labels) !!},
                        datasets: [{
                            label: 'Total Terjual',
                            data: {!! json_encode($top_jamu_data) !!},
                            backgroundColor: '#60a5fa',
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        scales: {
                            x: {
                                ticks: {
                                    color: '#fff'
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#fff'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Top Produk Jamu Terjual',
                                color: '#fff'
                            }
                        }
                    }
                });
            </script>
        </div>
    @else
        <div
            class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Statistik Penjualan</h3>
            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Produk Jamu</span>
            <p class="text-sm mt-4 text-gray-600 dark:text-gray-300">Belum ada data penjualan jamu.</p>
        </div>
    @endif
</div>

<script>
    const ctx = document.getElementById('kategoriChart').getContext('2d');
    const kategoriChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($labels_kategori) !!},
            datasets: [{
                label: 'Jumlah Jamu',
                data: {!! json_encode($data_kategori) !!},
                backgroundColor: [
                    '#60a5fa', '#f87171', '#34d399', '#facc15',
                    '#a78bfa', '#f472b6', '#38bdf8', '#fb923c',
                    '#4ade80', '#fcd34d', '#c084fc', '#f9a8d4'
                ].slice(0, {{ count($labels_kategori) }}),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Jumlah Jamu berdasarkan Kategori',
                },
                datalabels: {
                    color: '#fff',
                    formatter: (value, ctx) => {
                        const sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / sum) * 100).toFixed(1) + '%';
                        return value + ' (' + percentage + ')';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
