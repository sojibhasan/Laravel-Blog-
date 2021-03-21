@if ($paginator->hasPages())
<nav>
    <div class="pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="javascript:void(0)"><span aria-hidden="true">prev</span></a>
            </li>
            @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')">prev</a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="disabled" aria-disabled="true"><a href="javascript:void(0)"><span>{{ $element }}</span></a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="active" aria-current="page"><a href="javascript:void(0)"><span>{{ $page }}</span></a></li>
            @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">next</a>
            </li>
            @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="javascript:void(0)"><span aria-hidden="true">next</span></a>
            </li>
            @endif
        </ul>
    </div>
</nav>
@endif
