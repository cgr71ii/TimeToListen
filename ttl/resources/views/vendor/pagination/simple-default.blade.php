
<!-- Adding "true ||" to next line to force to show links and don't remove original code. -->

@if (true || $paginator->hasPages())

    <ul class="pagination">
        <!--div align="center"-->
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>@lang('pagination.previous')</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="disabled"><span>@lang('pagination.next')</span></li>
            @endif
        <!--/div-->
    </ul>

@endif
