<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Alamat') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update atau tambahkan alamat tempat tinggal anda.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.addAddress') }}" class="mt-6 space-y-6">
        @csrf
        {{-- Input Alamat --}}
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Baru</label>
            <textarea id="alamat" name="alamat" rows="3" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'alamat-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">{{ __('Alamat berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>

    @if (session('status') === 'alamat-deleted')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm mt-2 text-red-600">
            {{ __('Alamat berhasil dihapus.') }}</p>
    @endif

    @foreach ($alamat as $alt)
        <div class="mt-6 p-4 bg-white shadow rounded-lg flex justify-between items-center">
            <p class="text-gray-800">{{ $alt->alamat }}</p>
            <form method="post" action="{{ route('profile.deleteAddress', $alt->id_alamat) }}" class="mt-2">
                @csrf
                @method('DELETE')
                <button class="rounded-md">
                    <svg class="w-[20px] h-[20px] text-red-500 hover:text-red-900" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                    </svg>
                </button>
            </form>
        </div>
    @endforeach
</section>
