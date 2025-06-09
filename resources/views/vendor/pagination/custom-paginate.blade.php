@php
    $currentPage = $pagination->currentPage();
    $lastPage = $pagination->lastPage();

    $start = max($currentPage - 2, 1);
    $end = min($start + 4, $lastPage);
    if ($end - $start < 4) {
        $start = max($end - 4, 1);
    }
@endphp

<nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
    <ul class="flex h-8 items-center -space-x-px text-sm">

        {{-- Previous --}}
        <li>
            @if ($pagination->onFirstPage())
                <span
                    class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-gray-200 px-3 leading-tight text-gray-400 cursor-not-allowed"
                    aria-disabled="true" aria-label="Previous">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 19-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $pagination->previousPageUrl() }}"
                    class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                    rel="prev" aria-label="Previous">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 19-7-7 7-7" />
                    </svg>
                </a>
            @endif
        </li>

        {{-- First page and leading dots --}}
        @if ($start > 1)
            <li>
                <a href="{{ $pagination->url(1) }}"
                    class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    1
                </a>
            </li>
            @if ($start > 2)
                <li>
                    <span
                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 select-none">
                        ...
                    </span>
                </li>
            @endif
        @endif

        {{-- Page numbers --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $currentPage)
                <li>
                    <span
                        class="z-10 flex h-8 items-center justify-center border border-primary-300 bg-primary-50 px-3 leading-tight text-primary-600 hover:bg-primary-100 hover:text-primary-700"
                        aria-current="page">{{ $page }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $pagination->url($page) }}"
                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                        {{ $page }}
                    </a>
                </li>
            @endif
        @endfor

        {{-- Trailing dots and last page --}}
        @if ($end < $lastPage)
            @if ($end < $lastPage - 1)
                <li>
                    <span
                        class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 select-none">
                        ...
                    </span>
                </li>
            @endif
            <li>
                <a href="{{ $pagination->url($lastPage) }}"
                    class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700">
                    {{ $lastPage }}
                </a>
            </li>
        @endif

        {{-- Next --}}
        <li>
            @if ($pagination->hasMorePages())
                <a href="{{ $pagination->nextPageUrl() }}"
                    class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                    rel="next" aria-label="Next">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m9 5 7 7-7 7" />
                    </svg>
                </a>
            @else
                <span
                    class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-gray-200 px-3 leading-tight text-gray-400 cursor-not-allowed"
                    aria-disabled="true" aria-label="Next">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m9 5 7 7-7 7" />
                    </svg>
                </span>
            @endif
        </li>
    </ul>
</nav>
