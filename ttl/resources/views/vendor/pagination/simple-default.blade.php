@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <!--<li class="disabled"><span>@lang('pagination.previous')</span></li>-->
            <span>@lang('pagination.previous')</span>
        @else
            <!--<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>-->
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        @endif

        <!-- New -->
        &nbsp;
        <!-- End New -->

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <!--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>-->
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        @else
            <!--<li class="disabled"><span>@lang('pagination.next')</span></li>-->
            <span>@lang('pagination.next')</span>
        @endif
    </ul>
@endif
