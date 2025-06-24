@extends('layout', ['title' => 'Detail Pesanan'])

@section('page-content')
    <section id="top" class="bg-white py-8 antialiased md:py-16">
        {{-- Load Alert --}}
        @include('components.flowbite-alert')

        <form action="{{ route('pesanan.submit', $transaksi->id_transaksi) }}" method="POST"
            class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @csrf
            <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 sm:mt-8">
                <h4 class="text-lg font-semibold text-gray-900">Informasi Penagihan & Pengiriman</h4>

                @if ($transaksi->status_pembayaran == 0)
                    <p class="text-sm text-gray-500">Alamat: {{ $transaksi->user->alamat->alamat ?? 'Tidak ada alamat' }}
                    </p>
                @endif
            </div>
            <input type="hidden" name="alamat_id" value="{{ $transaksi->id_alamat }}">

            <script>
                document.getElementById('alamat-select').addEventListener('change', function() {
                    if (this.value === 'add-new') {
                        window.location.href = "{{ route('profile.edit') }}";
                    }
                });
            </script>

            <div class="mt-6 sm:mt-8">
                <div class="relative overflow-x-auto border-b border-gray-200">
                    <table class="w-full text-left font-medium text-gray-900 md:table-fixed">
                        <thead>
                            <tr class="text-sm text-gray-600 border-b border-gray-200">
                                <th class="py-2">Produk</th>
                                <th class="py-2 text-center">Jumlah</th>
                                <th class="py-2 pr-4 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($transaksi->detilTransaksi as $item)
                                <tr>
                                    <td class="whitespace-nowrap py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ asset('assets/images/products/' . $item->jamu->gambar) ?? 'https://via.placeholder.com/50' }}"
                                                alt="{{ $item->jamu->nama_jamu }}" class="w-10 h-10 object-cover">
                                            <span>{{ $item->jamu->nama_jamu }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-base text-center">x{{ $item->jumlah }}</td>
                                    <td class="p-4 text-right text-base font-bold text-gray-900">
                                        {{ rupiah($item->jamu->harga * $item->jumlah) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 space-y-6">
                    <h4 class="text-xl font-semibold text-gray-900">Total Transaksi</h4>
                    <div class="space-y-2 text-sm text-gray-500">
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
                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2">
                        <dt class="text-lg font-bold text-gray-900">Total</dt>
                        <dd class="text-lg font-bold text-gray-900">
                            {{ rupiah($transaksi->total_transaksi) }}</dd>
                    </dl>

                    {{-- <div class="flex items-start sm:items-center">
                            <input id="terms-checkbox-2" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500" />
                            <label for="terms-checkbox-2" class="ms-2 text-sm font-medium text-gray-900">
                                I agree with the
                                <a href="#" title="" class="text-primary-700 underline hover:no-underline">Terms
                                    and Conditions</a>
                                of use of the Flowbite marketplace
                            </label>
                        </div> --}}

                    <div class="gap-4 sm:flex sm:items-center">
                        <a href="{{ route('pesanan.index') }}"
                            class="w-full text-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-300 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                            Kembali
                        </a>
                        @if ($transaksi->status_pembayaran == 0)
                            <button type="submit"
                                class="mt-0 flex w-full items-center justify-center rounded-lg bg-green-500 hover:bg-green-700 hover:text-white px-5 py-2.5 text-sm font-medium text-gray-100 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 sm:mt-0">
                                Bayar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </form>
    </section>
@endsection
