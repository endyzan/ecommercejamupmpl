@extends('layout', ['title' => 'Halaman Produk'])

@section('page-content')
    {{-- start-content --}}

    {{-- SEARCH --}}
    
    <form id="top" class="flex items-center max-w-[70%] mx-auto mt-[1vh]" method="GET"
        action="{{ route('product.index') }}">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="simple-search" name="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full ps-10 p-2.5"
                placeholder="Cari Jamu" value="{{ request('search') }}" required />
        </div>
        <button type="submit"
            class="p-[1.38vh] ms-2 text-sm font-medium text-white bg-red-500 hover:bg-red-800  rounded-lg border focus:ring-4 focus:outline-none focus:ring-red-300">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Cari</span>
        </button>
    </form>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('product.index') }}"
        class="max-w-[70%] mx-auto mt-10 flex flex-wrap gap-4 items-center justify-between">

        {{-- Filter Kategori --}}
        <div>
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" class="border border-gray-300 rounded p-2">
                <option value="">Semua Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}"
                        {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Rating --}}
        <div>
            <label for="rating">Minimal Rating:</label>
            <select name="rating" id="rating" class="border border-gray-300 rounded p-2">
                <option value="">Semua</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }}
                        bintang ke atas</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
            Terapkan Filter
        </button>
    </form>


    {{-- <p class="text-center mt-4 text-gray-600">
        Menampilkan {{ count($jamus) }} produk.
    </p> --}}


    {{-- PRODUCT LIST --}}
    <table class="table table-striped table-bordered m-[10%] mx-auto mt-10" style="max-width:70%;">
        @foreach ($jamus as $jamu)
            <tr>
                <td width=230px>
                    <img src="{{ asset('assets/images/products/' . $jamu->gambar) }}" loading="lazy" height=150px
                        width=180px>
                </td>
                <td class="relative">
                    <h2>{{ $jamu->nama_jamu }}</h2>
                    <h4>{{ rupiah($jamu->harga) }}</h4>
                    <p>{{ $jamu->deskripsi }}</p>
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf

                        <span class="product_rating">
                            @for ($i = 1; $i <= $jamu->whole; $i++)
                                <i class="fa fa-star "></i>
                            @endfor

                            @if ($jamu->fraction != 0)
                                <i class="fa fa-star-half"></i>
                            @endif


                            <span class="rating_avg">({{ $jamu->rating }})</span>
                        </span>

                        <br>
                        <br>

                        @if ($jamu->stok > 0)
                            <input type="number" name="qty" style="width:50px;" id="myNumber" value="1">
                            <input type="hidden" name="id" value="{{ $jamu->id_jamu }}">
                            <button class="btn btn-success">Add to Cart</button>
                        @endif
                        @if ($jamu->stok < 1)
                            <p class="btn btn-danger">Out of Stock</p>
                        @endif
                    </form>
                    <a class="absolute right-4 bottom-2 hover:text-red-700"
                        href="{{ route('product.productDetail', $jamu->id_jamu) }}">></a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="mt-4">
        {{ $jamus->links('pagination::custom-paginate', ['pagination' => $jamus]) }}
    </div>


    {{-- end-content --}}
@endsection
