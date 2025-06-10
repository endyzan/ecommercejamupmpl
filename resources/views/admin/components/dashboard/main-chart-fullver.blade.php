<div
    class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
            <span class="text-lg font-bold leading-none text-gray-900 sm:text-2lg dark:text-white">
                Chart Pendapatan Penjualan Jamu
            </span>
            <h3 class="text-base font-light text-gray-500 dark:text-gray-400">
                Periode: {{ $startDate->translatedFormat('d M Y') }} – {{ $endDate->translatedFormat('d M Y') }}
            </h3>
        </div>
    </div>

    <canvas id="main-chart" height="100"></canvas>

    <!-- Dropdown filter waktu -->
    <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <!-- Dropdown Form -->
        <div>
            <form method="GET" action="{{ route('panel') }}">
                <div class="relative inline-block w-fit">
                    <select name="range" onchange="this.form.submit()"
                        class="appearance-none pr-8 pl-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-1 focus:ring-primary-500"
                        id="weekly-sales-dropdown" aria-label="Select date range">
                        <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 days</option>
                        <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 days</option>
                        <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 days</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        {{-- <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg> --}}
                    </div>
                </div>
            </form>
        </div>

        <!-- Report Button -->
        <div class="flex-shrink-0">
            <a href="#"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-gray-500 dark:hover:bg-gray-700">
                Laporan Transaksi
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const data = @json($data);

    const ctx = document.getElementById('main-chart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: data,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: ctx => `Rp ${ctx.formattedValue}`
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: value => 'Rp ' + value.toLocaleString()
                    }
                }
            }
        }
    });
</script>
