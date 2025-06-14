@extends('layout', ['title' => 'Product Detail'])

@section('page-content')
    <div id="top">
        @include('components.flowbite-alert')
        <h1 class="pl-4 text-2xl font-bold mb-4">Rating Produk</h1>

        <div class="lg:flex lg:w-screen lg:justify-center lg:items-center lg:gap-4">
            {{-- Show Image --}}
            <div class="lg:w-30% lg:h-[1vh] lg:mt-10 lg:mr-10">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('assets/images/products/' . $jamu->gambar) }}" alt="{{ $jamu->nama_jamu }}"
                        class="w-64 h-50 lg:w-64 lg:h-64 object-cover rounded-lg shadow-md">
                </div>
                {{-- Show Product Name --}}
                <h4 class="text-xl font-semibold text-center mb-2">{{ $jamu->nama_jamu }}</h4>
            </div>
            {{-- Form --}}
            <form action="{{ route('pesanan.rating.store') }}" method="POST" class="p-4 md:p-5 lg:w-[70%]">
                @csrf
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label for="rating-stars" class="mb-2 block text-md font-medium text-gray-900">Rating</label>
                        <div class="flex items-center">
                            <!-- Bintang rating -->
                            <div id="rating-stars" class="flex">
                                <!-- 5 bintang -->
                                <svg data-value="1" class="star h-6 w-6 cursor-pointer text-gray-300" fill="currentColor"
                                    viewBox="0 0 22 20">

                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg data-value="2" class="star h-6 w-6 cursor-pointer text-gray-300" fill="currentColor"
                                    viewBox="0 0 22 20">

                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg data-value="3" class="star h-6 w-6 cursor-pointer text-gray-300" fill="currentColor"
                                    viewBox="0 0 22 20">

                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg data-value="4" class="star h-6 w-6 cursor-pointer text-gray-300" fill="currentColor"
                                    viewBox="0 0 22 20">

                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                                <svg data-value="5" class="star h-6 w-6 cursor-pointer text-gray-300" fill="currentColor"
                                    viewBox="0 0 22 20">

                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <span id="rating-value" class="ms-2 text-lg font-bold text-gray-900">0 / 5</span>
                        </div>
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="0">

                    <script>
                        const stars = document.querySelectorAll('#rating-stars .star');
                        const ratingInput = document.getElementById('rating-input');
                        const ratingValue = document.getElementById('rating-value');

                        stars.forEach(star => {
                            star.addEventListener('click', () => {
                                const rating = star.getAttribute('data-value');
                                ratingInput.value = rating;
                                ratingValue.textContent = `${rating} / 5`;

                                // Reset semua bintang ke abu-abu
                                stars.forEach(s => s.classList.remove('text-yellow-300'));
                                stars.forEach(s => s.classList.add('text-gray-300'));

                                // Warnai bintang sesuai rating
                                for (let i = 0; i < rating; i++) {
                                    stars[i].classList.remove('text-gray-300');
                                    stars[i].classList.add('text-yellow-300');
                                }
                            });
                        });
                    </script>



                    <div class="col-span-2">
                        <label for="komentar" class="mb-2 block text-md font-medium text-gray-900">Komentar</label>
                        <textarea id="komentar" rows="6" name="komentar"
                            class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500"
                            required=""></textarea>
                        <p class="ms-auto text-xs text-gray-500">Ada masalah dengan produk atau pengiriman?
                            <a href="#" class="text-primary-600 hover:underline">Kirim laporan</a>.
                        </p>
                    </div>
                    <div class="col-span-2">
                        <div class="flex items-center">
                            <input id="review-checkbox" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500" />
                            <label for="review-checkbox" class="ms-2 text-sm font-medium text-gray-500">Dengan menerbitkan
                                ulasan
                                ini, Anda setuju dengan <a href="#" class="text-primary-600 hover:underline">syarat
                                    dan
                                    kondisi</a>.</label>
                        </div>
                    </div>
                    <input type="hidden" name="id_jamu" value="{{ $jamu->id_jamu }}">
                    {{-- Submit --}}
                    <div class="col-span-2">
                        <button type="submit"
                            class="w-full rounded-lg bg-red-900 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300">
                            Kirim Ulasan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
