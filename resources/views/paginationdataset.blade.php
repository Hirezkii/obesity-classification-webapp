<div class="flex justify-left">
    <nav class="bg-gray-200 rounded-full px-2 py-1">
        <ul class="flex text-gray-600 gap-2 font-medium py-1">
            {{-- Previous Page Link --}}
            @if ($personattributes->onFirstPage())
                <li>
                    <span
                        class="rounded-full px-2 py-1 bg-gray-300 text-gray-400 cursor-not-allowed text-sm">Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $personattributes->previousPageUrl() }}"
                        class="rounded-full px-2 py-1 bg-white text-gray-600 hover:bg-gray-100 text-sm">Previous</a>
                </li>
            @endif

            {{-- Page Number Links --}}
            @foreach ($personattributes->onEachSide(2)->getUrlRange(max(1, $personattributes->currentPage() - 2), min($personattributes->lastPage(), $personattributes->currentPage() + 2)) as $page => $url)
                <li>
                    <a href="{{ $url }}"
                        class="rounded-full px-2 py-1 {{ $page == $personattributes->currentPage() ? 'bg-white text-gray-600' : 'hover:bg-white hover:text-gray-600' }} text-sm">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($personattributes->hasMorePages())
                <li>
                    <a href="{{ $personattributes->nextPageUrl() }}"
                        class="rounded-full px-2 py-1 bg-white text-gray-600 hover:bg-gray-100 text-sm">Next</a>
                </li>
            @else
                <li>
                    <span
                        class="rounded-full px-2 py-1 bg-gray-300 text-gray-400 cursor-not-allowed text-sm">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>
