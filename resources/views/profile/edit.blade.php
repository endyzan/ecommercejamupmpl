<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-green-800 leading-tight">
                {{ __('Profile Settings') }}
            </h2>
            <div class="text-sm text-green-600">
                {{ __('Terakhir Diubah: ') }} {{ now()->format('M d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-green-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('rutetambahalamat'))
                <div class="flex items-center p-4 mb-0 pt-18 w-screen text-sm text-yellow-800 bg-yellow-50"
                    role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Peringatan!</span> {{ session('rutetambahalamat') }}
                    </div>
                </div>
            @endif
            <!-- Profile Information Section -->
            <div class="p-6 sm:p-8 bg-white shadow-md rounded-lg border border-green-200">
                <div class="flex items-center mb-6">
                    <div class="p-3 rounded-full bg-green-100 text-green-700 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">{{ __('Informasi Personal') }}</h3>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Address Information Section -->
            <div class="p-6 sm:p-8 bg-white shadow-md rounded-lg border border-green-200">
                <div class="flex items-center mb-6">
                    <div class="p-3 rounded-full bg-green-100 text-green-700 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">{{ __('Informasi Alamat') }}</h3>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-address-information-form')
                </div>
            </div>

            <!-- Password Section -->
            <div class="p-6 sm:p-8 bg-white shadow-md rounded-lg border border-green-200">
                <div class="flex items-center mb-6">
                    <div class="p-3 rounded-full bg-green-100 text-green-700 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">{{ __('Password & Keamanan') }}</h3>
                </div>
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
