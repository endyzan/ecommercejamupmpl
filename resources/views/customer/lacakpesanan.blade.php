@extends('layout', ['title' => 'Keranjang'])

@section('page-content')
    <section id="top" class="bg-white py-8 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl">Pelacakan Pesanan
                #TRX{{ str_pad($transaksi->id_transaksi, 8, '0', STR_PAD_LEFT) }}</h2>

            <div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
                <!-- KIRI: Daftar produk -->
                <div
                    class="w-full divide-y divide-gray-200 overflow-hidden rounded-lg border border-gray-200 lg:max-w-xl xl:max-w-2xl">
                    @foreach ($transaksi->detilTransaksi as $detail)
                        <div class="space-y-4 p-6">
                            <div class="flex items-center gap-6">
                                <a href="#" class="h-14 w-14 shrink-0">
                                    <img class="h-full w-full object-cover rounded"
                                        src="{{ asset('assets/images/products/' . $detail->jamu->gambar) ?? 'https://via.placeholder.com/64' }}"
                                        alt="{{ $detail->jamu->nama_jamu }}" />
                                </a>

                                <a href="#" class="min-w-0 flex-1 font-medium text-gray-900 hover:underline">
                                    {{ $detail->jamu->nama_jamu }}
                                </a>
                            </div>

                            <div class="flex items-center justify-between gap-4">
                                <p class="text-sm font-normal text-gray-500">
                                    <span class="font-medium text-gray-900">Product ID:</span>
                                    JAMU-{{ $detail->jamu->id_jamu }}
                                </p>

                                <div class="flex items-center justify-end gap-4">
                                    <p class="text-base font-normal text-gray-900">x{{ $detail->jumlah }}</p>
                                    <p class="text-xl font-bold leading-tight text-gray-900">
                                        {{ rupiah($detail->jamu->harga * $detail->jumlah) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- KANAN: Riwayat pengiriman -->
                <div class="mt-6 grow sm:mt-8 lg:mt-0">

                    <div class="space-y-4 bg-gray-50 p-6">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="font-normal text-gray-500">Biaya Pengantaran</dt>
                                <dd class="font-medium text-gray-900">{{ rupiah($biayaPengantaran) }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="font-normal text-gray-500">Pajak</dt>
                                <dd class="font-medium text-gray-900">{{ rupiah($pajak) }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                                <dt class="text-lg font-bold text-gray-900">Total</dt>
                                <dd class="text-lg font-bold text-gray-900">
                                    {{ rupiah($transaksi->total_transaksi) }}
                                </dd>
                            </dl>
                        </div>
                    </div>


                    <div class="mt-6 grow sm:mt-8 lg:mt-0">
                        <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900">Order history</h3>

                            <ol class="relative ms-3 border-s border-gray-200">
                                <li class="mb-10 ms-6">
                                    <span
                                        class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                        <svg class="h-4 w-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                        </svg>
                                    </span>
                                    <h4 class="mb-0.5 text-base font-semibold text-gray-900">Estimasi Sampai pada 24 Nov
                                        2023
                                    </h4>
                                    <p class="text-sm font-normal text-gray-500">Produk Telah Diterima</p>
                                </li>

                                <li class="mb-10 ms-6">
                                    <span
                                        class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                        <svg class="h-4 w-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                        </svg>
                                    </span>
                                    <h4 class="mb-0.5 text-base font-semibold text-gray-900">Today</h4>
                                    <p class="text-sm font-normal text-gray-500">Produk Sedang diantar</p>
                                </li>

                                <li class="ms-6 text-primary-700">
                                    <span
                                        class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white">
                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                    </span>
                                    <div>
                                        <h4 class="mb-0.5 font-semibold">19 Nov 2023, 10:45</h4>
                                        <a href="#" class="text-sm font-medium hover:underline">Produk Sedang
                                            Dikemas</a>
                                    </div>
                                </li>
                            </ol>

                            <div class="gap-4 sm:flex sm:items-center">
                                {{-- <button type="button"
                                class="w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                                Cancel the order
                            </button> --}}

                                <a href="{{ route('pesanan.index') }}"
                                    class="border border-gray-200 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-black hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 sm:mt-0">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
