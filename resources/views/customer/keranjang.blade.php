@extends('layout', ['title' => 'Keranjang'])

@section('page-content')
    <div class="pt-4">
        {{-- Load Alert --}}
        @include('components.flowbite-alert')

        @if (count($carts) > 0)
            {{-- Pilih Alamat Pengiriman --}}
            <div class="mb-6 flex justify-center">
                <div class="bg-white shadow-md rounded-lg p-4 border border-gray-200 w-[1300px]">
                    <h2 class="text-lg font-semibold text-gray-700 flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6c0 4 6 10 6 10s6-6 6-10a6 6 0 00-6-6zM8 8a2 2 0 114 0 2 2 0 01-4 0z" />
                        </svg>
                        Alamat Pengiriman
                    </h2>
                    <select name="alamat_id" id="alamat-select"
                        class="w-full rounded-lg border-gray-300 text-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50">
                        @forelse ($alamatUser as $alamat)
                            <option value="{{ $alamat->id_alamat }}">{{ $alamat->alamat }}</option>
                        @empty
                            <option disabled>Alamat belum tersedia</option>
                        @endforelse
                        <option value="add-new">+ Tambah Alamat Baru</option>
                    </select>
                </div>
            </div>



            <script>
                document.getElementById('alamat-select').addEventListener('change', function () {
                    if (this.value === 'add-new') {
                        window.location.href = "{{ route('profile.edit') }}";
                    }
                });
            </script>

            {{-- Tabel Keranjang --}}
            <table id="cart" class="table table-hover table-condensed container">
                <thead>
                    <tr>
                        <th style="width:50%">Nama Produk</th>
                        <th style="text-align:center;width:10%">Harga</th>
                        <th style="width:8%">Jumlah</th>
                        <th style="width:22%" class="text-center">Harga Total</th>
                        <th style="width:10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($carts as $product)
                        @php $total += $product->price * $product->quantity; @endphp
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td style="text-align:center">{{ rupiah($product->price) }}</td>
                            <td style="text-align:center">
                                <form action="{{ route('keranjang.update', ['id_jamu' => $product->id_jamu]) }}"
                                    method="POST" class="quantity-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $product->quantity }}" min="1"
                                        class="form-control form-control-sm quantity-input bg-transparent h-[26px] pr-0"
                                        style="width:60px; background-color: #f1f1f1; text-align:center;" readonly />
                                </form>
                            </td>
                            <td style="text-align:center">{{ rupiah($product->subtotal) }}</td>
                            <td style="text-align:center">
                                <button data-modal-target="c-m{{ $product->id_jamu }}-delete"
                                    data-modal-toggle="c-m{{ $product->id_jamu }}-delete"
                                    class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @include('customer.components.deletecart')
                    @endforeach

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const inputs = document.querySelectorAll('.quantity-input');
                            inputs.forEach(input => {
                                input.addEventListener('click', function () {
                                    if (this.hasAttribute('readonly')) {
                                        this.removeAttribute('readonly');
                                        this.style.backgroundColor = 'white';
                                        this.focus();
                                        this.select();
                                    }
                                });
                                input.addEventListener('change', function () {
                                    const form = this.closest('form');
                                    if (form) form.submit();
                                });
                            });
                        });
                    </script>

                    {{-- Tambahan Biaya (jika ada) --}}
                    @if ($total_price != 0)
                        @foreach ($extra_charge as $chrage)
                            <tr>
                                <td>{{ $chrage->name }}</td>
                                <td style="text-align:center"></td>
                                <td style="text-align:center"></td>
                                <td style="text-align:center">{{ rupiah($chrage->price) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <h3><strong>Total {{ rupiah($total_price) }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ route('product.index') }}" class="btn btn-warning">
                                <i class="fa fa-angle-left"></i> Continue Shopping
                            </a>
                            <form style="display:inline" method="post" action="{{ route('checkout.process') }}">
                                @csrf
                                <input type="hidden" name="alamat_id" id="alamat-hidden">
                                <button class="btn btn-success" {{ $total_price == 0 ? 'disabled' : '' }}>
                                    Checkout
                                </button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>

            <script>
                // Sync select value ke hidden input sebelum submit
                const checkoutForm = document.querySelector('form[action="{{ route('checkout.process') }}"]');
                checkoutForm.addEventListener('submit', function (e) {
                    const selectedAlamat = document.getElementById('alamat-select').value;
                    document.getElementById('alamat-hidden').value = selectedAlamat;
                });
            </script>
        @else
            <div class="text-center text-gray-500 py-12">
                <h1>Keranjang Masih Kosong !</h1>
            </div>
        @endif
    </div>
@endsection






<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
    }

    .success {
        padding: 20px;
        background-color: #4BB543;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
