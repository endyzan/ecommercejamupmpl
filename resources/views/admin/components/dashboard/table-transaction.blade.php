<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <!-- Card header -->
    <div class="items-center justify-between lg:flex">
        <div class="mb-4 lg:mb-0">
            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Manajemen Transaksi</h3>
            <span class="text-base font-normal text-gray-500 dark:text-gray-400">Kilas List Transaksi</span>
        </div>
    </div>
    <!-- Table -->
    <div class="flex flex-col mt-6">
        <div class="overflow-x-auto rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Nama Pembeli
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Waktu dan tanggal
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Nilai
                                </th>
                                {{-- <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Nomor telepon
                                </th> --}}
                                <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Nomor id Transaksi
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Status Pembayaran
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($tabel_transaksi as $t)
                                <tr>
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                        Dari <span class="font-semibold">{{ $t->user->name ?? 'user9091' }}</span>
                                    </td>
                                    <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $t->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td
                                        class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ rupiah($t->total_transaksi) }}
                                    </td>
                                    {{-- <td
                                        class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        0023568934
                                    </td> --}}
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        <span>#TRX{{ str_pad($t->id_transaksi, 8, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        @php
                                            $status = [
                                                0 => [
                                                    'label' => 'Belum Bayar',
                                                    'class' => 'border-yellow-100 text-yellow-800',
                                                    'dark_class' => 'dark:border-yellow-900 dark:text-yellow-300',
                                                ],
                                                1 => [
                                                    'label' => 'Dikemas',
                                                    'class' => 'border-blue-100 text-blue-800',
                                                    'dark_class' => 'dark:border-blue-900 dark:text-blue-300',
                                                ],
                                                2 => [
                                                    'label' => 'Dikirim',
                                                    'class' => 'border-indigo-100 text-indigo-800',
                                                    'dark_class' => 'dark:border-indigo-900 dark:text-indigo-300',
                                                ],
                                                3 => [
                                                    'label' => 'Diterima',
                                                    'class' => 'border-green-100 text-green-800',
                                                    'dark_class' => 'dark:border-green-900 dark:text-green-300',
                                                ],
                                                4 => [
                                                    'label' => 'Dibatalkan',
                                                    'class' => 'border-red-100 text-red-800',
                                                    'dark_class' => 'dark:border-red-900 dark:text-red-300',
                                                ],
                                            ];
                                        @endphp
                                        <span
                                            class="{{ $status[$t->status_pembayaran]['class'] }} text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border {{ $status[$t->status_pembayaran]['dark_class'] }}">{{ $status[$t->status_pembayaran]['label'] }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <td colspan="2" class="p-4 text-sm font-bold text-gray-900 whitespace-nowrap dark:text-white text-right">
                                    Total Nilai Transaksi:
                                </td>
                                <td class="p-4 text-sm font-bold text-green-700 whitespace-nowrap dark:text-green-400">
                                    {{ rupiah($tabel_transaksi->sum('total_transaksi')) }}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Card Footer -->
    <div class="flex items-center justify-between pt-3 sm:pt-6">
        {{-- <div>
            <button
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="transactions-dropdown">Last 7 days <svg class="w-4 h-4 ml-2"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                    </path>
                </svg></button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="transactions-dropdown">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white" role="none">
                        Sep 16, 2021 - Sep 22, 2021
                    </p>
                </div>
                <ul class="py-1" role="none">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Yesterday</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Today</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 7 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 30 days</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                            role="menuitem">Last 90 days</a>
                    </li>
                </ul>
                <div class="py-1" role="none">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Custom...</a>
                </div>
            </div>
        </div> --}}
        <div class="flex-shrink-0 text-right w-full">
            <a href="{{ route('panel.transactions') }}"
                class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100 dark:text-gray-500 dark:hover:bg-gray-700">
                LIHAT LEBIH LENGKAP
                <svg class="w-4 h-4 ml-1 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>
