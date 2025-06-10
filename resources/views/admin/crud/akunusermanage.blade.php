@extends('admin.layouts.app')

@section('content')
    <div class="px-4 sm:px-10 pt-20 w-full min-h-screen">
        <div class="w-full lg:w-[90%] lg:mx-auto">
            
            <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">Manajemen Pengguna</h1>

            {{-- Pesan Notifikasi (Sukses atau Error) --}}
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">Sukses!</span> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Error!</span> {{ session('error') }}
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Pengguna
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    {{-- Tombol delete hanya akan muncul jika pengguna yang login adalah Admin atau Manager --}}
                                    @if(in_array(Auth::user()->role, [1, 2]))
                                    <form action="{{ route('panel.akunuser.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Ini tidak dapat dikembalikan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="odd:bg-white odd:dark:bg-gray-900 border-b dark:border-gray-700">
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data pengguna.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links('pagination::custom-paginate-w-dark', ['pagination' => $users]) }}
            </div>
        </div>
    </div>
@endsection
