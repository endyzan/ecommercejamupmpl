<section class="bg-white py-8 antialiased md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="flex items-center gap-2">
            <h2 class="text-2xl font-semibold text-gray-900">Ulasan</h2>

            <div class="mt-2 flex items-center gap-2 sm:mt-0">
                <div class="flex items-center gap-0.5">
                    @for ($i = 1; $i <= 5; $i++)
                        @php
                            $star_color = $i <= $jamu->whole ? 'text-yellow-300' : 'text-gray-300';
                        @endphp

                        <svg class="w-4 h-4 {{ $star_color }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm font-medium leading-none text-gray-500">({{ $jamu->rating }})</p>
                <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">
                    {{ $jamu->reviewers }} Ulasan </a>
            </div>
        </div>

        <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
            <div class="shrink-0 space-y-4">
                <p class="text-2xl font-semibold leading-none text-gray-900">{{ $jamu->rating }} out of 5</p>
                {{-- <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal"
                    class="mb-2 me-2 rounded-lg bg-red-500 px-5 py-2.5 text-sm font-medium text-black hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">Write
                    a review</button> --}}
            </div>

            <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                @foreach ($jamu->rating_count as $key => $value)
                    @php
                        $totalVotes = $jamu->reviewers;
                        $percentage = $totalVotes > 0 ? ($value / $totalVotes) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-2">
                        <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900">
                            {{ $key }}
                        </p>
                        <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <div class="h-1.5 w-80 rounded-full bg-gray-200">
                            <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $percentage }}%"></div>
                        </div>
                        <a href="#"
                            class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline sm:w-auto sm:text-left">{{ $value }}
                            <span class="hidden sm:inline">Ulasan</span></a>
                    </div>
                @endforeach
            </div>
        </div>

        @foreach ($jamu->komentar as $komen)
            <div class="gap-3 py-6 sm:flex sm:items-start">
                <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                    <div class="flex items-center gap-0.5">
                        @for ($i = 1; $i <= 5; $i++)
                            @php
                                $star_color = $i <= $komen->rating ? 'text-yellow-300' : 'text-gray-300';
                            @endphp
                            <svg class="h-4 w-4 {{ $star_color }}" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                        @endfor
                    </div>

                    <div class="space-y-0.5">
                        <p class="text-base font-semibold text-gray-900">{{ $komen->nama_user }}</p>
                        <p class="text-sm font-normal text-gray-500">
                            {{ \Carbon\Carbon::parse($komen->created_at)->translatedFormat('j F Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                    <p class="text-base font-normal text-gray-500">{{ $komen->komentar }}</p>
                </div>
            </div>
        @endforeach
    </div>



    {{-- <div class="mt-6 text-center">
        <button type="button"
            class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View
            Muat Ulasan</button>
    </div> --}}
    </div>
</section>
