@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;Пред</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="color: #FFF">&laquo;Пред</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="" style="background-color: #FFF">...</a></li>
                        <li class="active"><span>{{ $page }}</span></li>
                        <li><a href="" style="background-color: #FFF">...</a></li>
                    {{-- @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" style="color: #FFF">След&raquo;</a></li>
        @else
            <li class="disabled"><span>След&raquo;</span></li>
        @endif
    </ul>
@endif
