{{-- @if ($paginator->hasPages()) --}}
<div class="dt-paging paging_simple_numbers">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="dt-paging-button page-item disabled"><a class="page-link previous" href="" rel="prev"><i
                        class="previous"></i></a></li>
        @else
            <li class="dt-paging-button page-item"><a class="page-link previous" href="{{ $paginator->previousPageUrl() }}"
                    rel="prev"><i class="previous"></i> </a></li>
        @endif

        {{-- Pagination Elements --}}
        @php
            // Calculate the range of pages to display
            $start = max(1, $paginator->currentPage() - 1);
            $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
        @endphp

        @if ($start > 1)
            {{-- Display first page link --}}
            <li class="dt-paging-button page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
            {{-- Display ellipsis --}}
            @if ($start > 2)
                <li class="disabled"><span>...</span></li>
            @endif
        @endif

        {{-- Display page links --}}
        @for ($i = $start; $i <= $end; $i++)
            <li class="dt-paging-button page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($end < $paginator->lastPage())
            {{-- Display ellipsis --}}
            @if ($end < $paginator->lastPage() - 1)
                <li class="disabled"><span>...</span></li>
            @endif
            {{-- Display last page link --}}
            <li class="dt-paging-button page-item"><a class="page-link"
                    href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="dt-paging-button page-item"><a class="page-link next" href="{{ $paginator->nextPageUrl() }}"
                    rel="next"><i class="next"></i></a></li>
        @else
            <li class="dt-paging-button page-item disabled"><a class="page-link next"><i class="next"></i></a></li>
        @endif
    </ul>
</div>
{{-- @else
<div class="dt-paging paging_simple_numbers">
    <ul class="pagination">
        <li class="dt-paging-button page-item disabled"><a class="page-link previous" href="" rel="prev"><i class="previous"></i></a></li>
        <li class="dt-paging-button page-item disabled"><a class="page-link next" rel="next"><i class="next"></i></a></li>
    </ul>
</div>
@endif --}}
