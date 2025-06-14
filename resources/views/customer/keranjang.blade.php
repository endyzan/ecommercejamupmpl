@extends('layout', ['title' => 'Keranjang'])

@section('page-content')
    <div>
        <br>
        {{-- Load Alert --}}
        @include('components.flowbite-alert')

        <br>

        <br>
        <br>

        @if (count($carts) != 0)
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
                    @php $total = 0 @endphp
                    @foreach ($carts as $product)
                        @php $total += $product->price * $product->quantity @endphp
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
                                    class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash">
                                    </i></button>
                            </td>
                        </tr>
                        @include('customer.components.deletecart')
                    @endforeach

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputs = document.querySelectorAll('.quantity-input');

                            inputs.forEach(input => {
                                // Saat pertama diklik, hilangkan readonly
                                input.addEventListener('click', function() {
                                    if (this.hasAttribute('readonly')) {
                                        this.removeAttribute('readonly');
                                        this.style.backgroundColor = 'white';
                                        this.focus();
                                        this.select();
                                    }
                                });

                                // Jika nilai berubah, submit form secara otomatis
                                input.addEventListener('change', function() {
                                    const form = this.closest('form');
                                    if (form) form.submit();
                                });
                            });
                        });
                    </script>



                    @if ($total_price != 0)
                        @foreach ($extra_charge as $chrage)
                            <tr>
                                <td>{{ $chrage->name }}</td>
                                <td style="text-align:center"></td>
                                <td style="text-align:center"></td>


                                <td style="text-align:center">{{ rupiah($chrage->price) }}</td>



                            </tr>
                        @endforeach
                    @endif
                    @php

                    @endphp
                </tbody>
                <tfoot>
                    </tr>
                    <tr>
                        @php
                        @endphp
                    <tr>

                        <td colspan="5" class="text-right">
                            <h3><strong>Total {{ rupiah($total_price) }}</strong></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="{{ route('product.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                                Continue
                                Shopping</a>
                            <form style="display:inline" method="post" action="{{ route('checkout.process') }}">
                                @csrf
                                @if ($total_price == 0)
                                    <button class="btn btn-success" disabled>Checkout</button>
                                @else
                                    <button class="btn btn-success">Checkout</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
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
