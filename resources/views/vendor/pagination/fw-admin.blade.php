@if ($paginator->hasPages())
    <nav class="fw-admin-pagination-nav" role="navigation" aria-label="Pagination Navigation">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="fw-admin-page-link fw-admin-page-link--disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                    </span>
                </li>
            @else
                <li>
                    <a class="fw-admin-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                    </a>
                </li>
            @endif

            {{-- $elements is the truncated window from Paginator::elements() (injected by links()) --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="fw-admin-page-ellipsis" aria-hidden="true">…</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="fw-admin-page-link fw-admin-page-link--active" aria-current="page">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="fw-admin-page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="fw-admin-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="fw-admin-page-link fw-admin-page-link--disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
