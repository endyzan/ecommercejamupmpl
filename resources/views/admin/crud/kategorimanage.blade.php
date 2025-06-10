@extends('admin.layouts.app')

@section('content')
    <div class="px-10 pt-20 w-full min-h-screen overflow-hidden">
        <div class="w-full lg:w-[80%] lg:mx-auto">
            <div class="w-full flex justify-end items-end py-3">
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Jamu
                            </th>
                            <th scope="col" class="px-6 py-3 flex items-end justify-end">
                                <span class="pr-5">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $k->nama_kategori }}
                                </th>
                                <td class="px-6 py-4 flex items-end justify-end">
                                    <a href="#"
                                        class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <a href="#"
                                        class="ml-2 font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="w-full flex justify-end items-end py-3">
                    <button type="button"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Tambah Kategori
                    </button>
                </div>
            </div>
            <div class="mt-4">
                {{ $kategori->links('pagination::custom-paginate-w-dark', ['pagination' => $kategori]) }}
            </div>
        </div>
    </div>
@endsection
