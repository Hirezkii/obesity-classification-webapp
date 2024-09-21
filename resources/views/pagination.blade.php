<div class="flex justify-left">
    <nav class="bg-gray-200 rounded-full px-2 py-1">
        <ul class="flex text-gray-600 gap-2 font-medium py-1">
            {{-- Previous Page Link --}}
            @if ($userinputs->onFirstPage())
                <li>
                    <span
                        class="rounded-full px-2 py-1 bg-gray-300 text-gray-400 cursor-not-allowed text-sm">Previous</span>
                </li>
            @else
                <li>
                    <a href="{{ $userinputs->previousPageUrl() }}"
                        class="rounded-full px-2 py-1 bg-white text-gray-600 hover:bg-gray-100 text-sm">Previous</a>
                </li>
            @endif

            {{-- Page Number Links --}}
            @foreach ($userinputs->onEachSide(2)->getUrlRange(max(1, $userinputs->currentPage() - 2), min($userinputs->lastPage(), $userinputs->currentPage() + 2)) as $page => $url)
                <li>
                    <a href="{{ $url }}"
                        class="rounded-full px-2 py-1 {{ $page == $userinputs->currentPage() ? 'bg-white text-gray-600' : 'hover:bg-white hover:text-gray-600' }} text-sm">
                        {{ $page }}
                    </a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($userinputs->hasMorePages())
                <li>
                    <a href="{{ $userinputs->nextPageUrl() }}"
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
