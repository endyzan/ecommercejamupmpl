@extends('layout', ['title' => 'Daftar Pesanan'])

@section('page-content')
    <section id="top" class="bg-white py-8 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            {{-- Load Alert --}}
            @include('components.flowbite-alert')

            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Pesanan Saya</h2>
                    {{--
                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <div>
                            <label for="order-type" class="sr-only">Select order type</label>
                            <select id="order-type"
                                class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                <option selected>Semua Pesanan</option>
                                <option value="Belum Bayar">Belum Bayar</option>
                                <option value="Dikirim">Dikirim</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </div>

                        <span class="inline-block text-gray-500">from</span>

                        <div>
                            <label for="duration" class="sr-only">Select duration</label>
                            <select id="duration"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500">
                                <option selected>Minggu Ini</option>
                                <option value="this month">Bulan Ini</option>
                                <option value="last 3 months">3 Bulan Terakhir</option>
                                <option value="last 6 months">6 Bulan Terakhir</option>
                                <option value="this year">Tahun Ini</option>
                            </select>
                        </div>
                    </div> --}}
                </div>


                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <div class="order-card flex flex-wrap items-center gap-y-4 py-6 border border-gray-200 rounded-xl shadow-sm p-5 mb-4"
                                data-order-type="{{ $order->tipe_order }}"
                                data-date="{{ \Carbon\Carbon::parse($order->tanggal_transaksi)->format('Y-m-d') }}">

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1 border-b sm:border-0 sm:pr-4">
                                    <dt class="text-sm font-medium text-gray-500">ID Pesanan</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">
                                        <a href="#"
                                            class="hover:underline">#TRX{{ str_pad($order->id_transaksi, 8, '0', STR_PAD_LEFT) }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1 border-b sm:border-0 sm:pr-4">
                                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($order->tanggal_transaksi)->format('d.m.Y') }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1 border-b sm:border-0 sm:pr-4">
                                    <dt class="text-sm font-medium text-gray-500">Harga</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900">
                                        {{ rupiah($order->total_transaksi) }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        @php
                                            $status = [
                                                0 => [
                                                    'label' => 'Belum Bayar',
                                                    'class' => 'bg-yellow-100 text-yellow-800',
                                                ],
                                                1 => ['label' => 'Dikemas', 'class' => 'bg-blue-100 text-blue-800'],
                                                2 => ['label' => 'Dikirim', 'class' => 'bg-indigo-100 text-indigo-800'],
                                                3 => ['label' => 'Diterima', 'class' => 'bg-green-100 text-green-800'],
                                                4 => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-800'],
                                            ];
                                        @endphp

                                        <span
                                            class="inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium {{ $status[$order->status_pembayaran]['class'] }}">
                                            {{ $status[$order->status_pembayaran]['label'] }}
                                        </span>
                                    </dd>

                                </dl>

                                <div
                                    class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-3 pt-4">
                                    @if ($order->status_pembayaran == 0)
                                        <a href="{{ route('pesanan.cancel', $order->id_transaksi) }}"
                                            class="w-full lg:text-[11.5px] text-sm inline-flex justify-center rounded-lg border border-gray-300 bg-red-500 px-3 py-2 font-medium text-gray-100 hover:bg-red-700 hover:text-white transition">
                                            Batalkan Pesanan
                                        </a>
                                    @elseif ($order->status_pembayaran == 3)
                                        <a href="{{ route('pesanan.detail', $order->id_transaksi) }}"
                                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 transition">
                                            Lihat Detil
                                        </a>
                                    @else
                                        <a href="{{ route('pesanan.track', $order->id_transaksi) }}"
                                            class="w-full lg:text-[11.5px] text-sm inline-flex justify-center rounded-lg border border-gray-300 bg-blue-500 px-3 py-2 font-medium text-gray-100 hover:bg-blue-700 hover:text-white transition">
                                            Lacak Pesanan
                                        </a>
                                    @endif
                                    @if ($order->status_pembayaran == 0)
                                        <a href="{{ route('pesanan.detail', $order->id_transaksi) }}"
                                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 bg-green-500 px-3 py-2 text-sm font-medium text-gray-100 hover:bg-green-700 hover:text-white transition">
                                            Bayar
                                        </a>
                                    @elseif ($order->status_pembayaran == 1)
                                        <a href="{{ route('pesanan.detail', $order->id_transaksi) }}"
                                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 transition">
                                            Lihat Detil
                                        </a>
                                    @elseif ($order->status_pembayaran == 2)
                                        <a href="{{ route('pesanan.complete', $order->id_transaksi) }}"
                                            class="w-full inline-flex justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-green-500 transition">
                                            Pesanan Selesai
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-12">
                                <p>Belum ada pesanan yang dibuat.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (count($orders) != 0)
        <div class="mt-4">
            {{ $orders->links('pagination::custom-paginate', ['pagination' => $orders]) }}
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const orderTypeSelect = document.getElementById('order-type');
            const durationSelect = document.getElementById('duration');
            const orderCards = document.querySelectorAll('.order-card');

            function filterOrders() {
                const selectedType = orderTypeSelect.value;
                const selectedDuration = durationSelect.value;
                const today = new Date();

                orderCards.forEach(card => {
                    const orderType = card.dataset.orderType;
                    const orderDate = new Date(card.dataset.date);
                    let showCard = true;

                    // Filter jenis pesanan
                    if (selectedType !== 'Semua Pesanan' && orderType !== selectedType) {
                        showCard = false;
                    }

                    // Filter durasi
                    if (showCard) {
                        let startDate;
                        switch (selectedDuration) {
                            case 'Minggu Ini':
                                startDate = new Date(today);
                                startDate.setDate(today.getDate() - 7);
                                break;
                            case 'this month':
                                startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                                break;
                            case 'last 3 months':
                                startDate = new Date(today);
                                startDate.setMonth(today.getMonth() - 3);
                                break;
                            case 'last 6 months':
                                startDate = new Date(today);
                                startDate.setMonth(today.getMonth() - 6);
                                break;
                            case 'this year':
                                startDate = new Date(today.getFullYear(), 0, 1);
                                break;
                            default:
                                startDate = null;
                        }
                        if (startDate && orderDate < startDate) {
                            showCard = false;
                        }
                    }

                    card.style.display = showCard ? 'flex' : 'none';
                });
            }

            orderTypeSelect.addEventListener('change', filterOrders);
            durationSelect.addEventListener('change', filterOrders);
        });
    </script>
@endpush
