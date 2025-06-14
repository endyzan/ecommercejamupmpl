@extends('admin.layouts.app')

@section('content')
    <div class="px-10 pt-20 w-full min-h-screen overflow-hidden">
        {{-- Load Alert --}}
        @include('components.flowbite-alert')

        {{-- Load All Modal --}}
        @foreach ($jamu as $j)
            @include('admin.components.crud.deleteproductmodal')
            @include('admin.components.crud.editproductmodal')
        @endforeach
        @include('admin.components.crud.addproductmodal')
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
                        @foreach ($jamu as $j)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $j->nama_jamu }}
                                </th>
                                <td class="px-6 py-4 flex items-end justify-end">
                                    <button data-modal-target="crud-edit-{{ $j->id_jamu }}-modal"
                                        data-modal-toggle="crud-edit-{{ $j->id_jamu }}-modal"
                                        class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        type="button">
                                        Edit
                                    </button>
                                    <button data-modal-target="popup-delete-{{ $j->id_jamu }}-modal"
                                        data-modal-toggle="popup-delete-{{ $j->id_jamu }}-modal"
                                        class="ml-2 font-medium text-red-600 dark:text-red-500 hover:underline"
                                        type="button">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="w-full flex justify-end items-end py-3">
                    <button data-modal-target="crud-create-modal" data-modal-toggle="crud-create-modal" type="button"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Tambah Jamu
                    </button>
                </div>
            </div>
            <div class="mt-4">
                {{ $jamu->links('pagination::custom-paginate-w-dark', ['pagination' => $jamu]) }}
            </div>
        </div>
    </div>
@endsection
