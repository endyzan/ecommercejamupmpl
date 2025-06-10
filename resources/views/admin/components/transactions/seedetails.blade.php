@extends('admin.layouts.app')

@section('content')
    <div class="px-10 pt-20 w-full min-h-screen overflow-hidden bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <form action="{{ route('pesanan.submit', $transaksi->id_transaksi) }}" method="POST"
            class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @csrf
            <div class="mt-6 space-y-4 border-b border-t border-gray-200 dark:border-gray-700 py-8 sm:mt-8">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Penagihan & Pengiriman</h4>

                <label for="alamat-select" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Alamat
                    Tujuan</label>
                {{ $transaksi->user->alamat->alamat }}
            </div>

            <div class="mt-6 sm:mt-8">
                <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-700">
                    <table class="w-full text-left font-medium text-gray-900 dark:text-gray-100 md:table-fixed">
                        <thead>
                            <tr
                                class="text-sm text-gray-600 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                                <th class="py-2">Produk</th>
                                <th class="py-2 text-center">Jumlah</th>
                                <th class="py-2 pr-4 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($transaksi->detilTransaksi as $item)
                                <tr>
                                    <td class="whitespace-nowrap py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('assets/images/products/' . $item->jamu->gambar) ?? 'https://via.placeholder.com/50' }}"
                                                alt="{{ $item->jamu->nama_jamu }}" class="w-10 h-10 object-cover rounded">
                                            <span>{{ $item->jamu->nama_jamu }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base text-center">x{{ $item->jumlah }}</td>
                                    <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-gray-100">
                                        {{ rupiah($item->jamu->harga * $item->jumlah) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 space-y-6">
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Total Transaksi</h4>
                    <div class="space-y-2 text-sm text-gray-500 dark:text-gray-300">
                        <dl class="flex items-center justify-between gap-4">
                            <dt>Subtotal</dt>
                            <dd>{{ rupiah($transaksi->total_transaksi - $biayaPengantaran - $pajak) }}</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt>Biaya Pengantaran</dt>
                            <dd>{{ rupiah($biayaPengantaran) }}</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt>Pajak</dt>
                            <dd>{{ rupiah($pajak) }}</dd>
                        </dl>
                    </div>
                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 dark:border-gray-700 pt-2">
                        <dt class="text-lg font-bold text-gray-900 dark:text-gray-100">Total</dt>
                        <dd class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            {{ rupiah($transaksi->total_transaksi) }}</dd>
                    </dl>

                    <div class="gap-4 sm:flex sm:items-center">
                        <a href="{{ route('panel.transactions') }}"
                            class="w-full text-center rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-800 px-5 py-2.5 text-sm font-medium text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-700 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">
                            Kembali
                        </a>
                        @if ($transaksi->status_pembayaran == 1)
                            <a href="{{ route('panel.transaction.batal', $transaksi->id_transaksi) }}"
                                class="mt-4 sm:mt-0 flex w-full items-center justify-center rounded-lg bg-red-500 hover:bg-red-700 px-5 py-2.5 text-sm font-medium text-white dark:text-white focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700">
                                Batalkan Pesanan
                            </a>
                        @endif
                    </div>
                    @if ($transaksi->status_pembayaran == 1)
                        <a href="{{ route('panel.transaction.send', $transaksi->id_transaksi) }}"
                            class="mt-4 sm:mt-0 flex w-full items-center justify-center rounded-lg bg-green-500 hover:bg-green-700 px-5 py-2.5 text-sm font-medium text-white dark:text-white focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700">
                            Kirim Pesanan
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
