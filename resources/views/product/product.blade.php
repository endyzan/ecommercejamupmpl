@extends('layout', ['title' => 'Product Detail'])

@section('page-content')
    <div id="top">
        @include('components.flowbite-alert')

        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <h1 class="pl-4 text-2xl font-bold mb-4">Detail Produk</h1>

            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full" src="{{ asset('assets/images/products/' . $jamu->gambar) }}" alt="" />
                    {{-- <img class="w-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                        alt="" /> --}}
                    {{-- <img class="w-full hidden dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" /> --}}
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">
                        {{ $jamu->nama_jamu }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                            {{ rupiah($jamu->harga) }}
                        </p>
                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @php
                                        $star_color = $i <= $jamu->whole ? 'text-yellow-300' : 'text-gray-300';
                                    @endphp

                                    <svg class="w-4 h-4 {{ $star_color }}" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                @endfor

                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500">
                                {{ $jamu->rating }}
                            </p>
                            <a href="#"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">
                                {{ $jamu->reviewers }} Ulasan
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        {{-- <a href="#" title=""
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-500 focus:z-10 focus:ring-4 focus:ring-gray-100"
                            role="button">
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                            Add to favorites
                        </a> --}}
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="qty" class="w-[45px] h-[39px] text-center" id="myNumber"
                                value="1">
                            <input type="hidden" name="id" value="{{ $jamu->id_jamu }}">

                            <button type="submit"
                                class="text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center justify-center">
                                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>

                    </div>

                    <hr class="my-6 md:my-8 border-gray-200" />

                    <p class="mb-6 text-gray-500">
                        {{ $jamu->nama_jamu }}, {{ $jamu->deskripsi }} Bermanfaat untuk {{ $jamu->manfaat }}
                        <br>
                        Komposisi : {{ $jamu->komposisi }}
                        <br>
                        Dosis : {{ $jamu->aturan_pakai }}
                    </p>

                    {{-- <p class="text-gray-500">
                        Two Thunderbolt USB 4 ports and up to two USB 3 ports. Ultrafast
                        Wi-Fi 6 and Bluetooth 5.0 wireless. Color matched Magic Mouse with
                        Magic Keyboard or Magic Keyboard with Touch ID.
                    </p> --}}
                </div>
            </div>
        </div>
    </div>


    @include('product.components.comments')
@endsection
