<!-- Main modal -->
<div id="crud-edit-{{ $j->id_jamu }}-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Produk - {{ $j->nama_jamu }}
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-edit-{{ $j->id_jamu }}-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" method="POST" action="{{ route('panel.produk.update', $j->id_jamu) }}">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="user_avatar">Upload file</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="user_avatar_help" id="user_avatar" name="gambar" type="file">
                        <small class="text-xs text-gray-500 dark:text-gray-300">Kosongkan jika tidak ingin
                            mengganti.</small>
                    </div>

                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Jamu</label>
                        <input type="text" name="nama_jamu" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $j->nama_jamu }}" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="harga"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="number" name="harga" id="harga"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $j->harga }}" required>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <label for="stok"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input type="number" name="stok" id="stok"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $j->stok }}" required>
                    </div>

                    <div class="col-span-2">
                        <label for="id_kategori"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="id_kategori" name="id_kategori[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            multiple>
                            @foreach ($kategoriList as $kategori)
                                <option value="{{ $kategori->id_kategori }}"
                                    {{ in_array($kategori->id_kategori, $j->id_kategori ?? []) ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-gray-500 text-xs">Tekan Ctrl (Cmd di Mac) untuk memilih lebih dari
                            satu</small>
                    </div>

                    <div class="col-span-2">
                        <label for="komposisi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Komposisi
                            Produk</label>
                        <textarea name="komposisi" id="komposisi" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>{{ old('komposisi', $j->komposisi) }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="deskripsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi
                            Produk</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>{{ old('deskripsi', $j->deskripsi) }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="aturan_pakai"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aturan Pakai
                            Produk</label>
                        <textarea name="aturan_pakai" id="aturan_pakai" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>{{ old('aturan_pakai', $j->aturan_pakai) }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat
                            ( Gram )</label>
                        <input type="text" name="berat" id="berat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            value="{{ $j->berat }}" required>
                    </div>

                    <div class="col-span-2">
                        <label for="manfaat"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Manfaat
                            Produk</label>
                        <textarea name="manfaat" id="manfaat" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>{{ old('manfaat', $j->manfaat) }}</textarea>
                    </div>
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
