@extends('layout', ['title' => 'Home'])

@section('page-content')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" --}}
    {{-- integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="style.css"> --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous"> --}}
    {{-- <script src="script.js"></script> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> --}}



    {{-- start-content --}}

    <form class="flex items-center max-w-sm mx-auto">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required />
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>


    <table class="table table-striped table-bordered" style="margin:10%; max-width:80%;">
        @foreach ($jamus as $jamu)
            <tr>
                <td>
                    <img src="{{ asset('assets/images/products/' . $jamu->gambar) }}" loading="lazy" height=150px width=180px>
                </td>
                <td>
                    <h2>{{ $jamu->nama_jamu }}</h2>
                    <h4>{{ rupiah($jamu->harga) }}</h4>
                    <p>{{ $jamu->deskripsi }}</p>
                    <form method="post" action="">
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
                            <input type="number" name="number" style="width:50px;" id="myNumber" value="1">
                            <button class="btn btn-success">Add to Cart</button>
                        @endif
                        @if ($jamu->stok < 1)
                            <p class="btn btn-danger">Out of Stock</p>
                        @endif
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $jamus->links() }}


    {{-- end-content --}}
@endsection
