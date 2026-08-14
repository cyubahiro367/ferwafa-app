@if(isset($paginator) && method_exists($paginator, 'links'))
    <div class="fw-admin-pagination">
        <div class="fw-admin-muted">
            @if($paginator->total() > 0)
                Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
            @else
                No results
            @endif
        </div>
        <div>
            {{ $paginator->withQueryString()->links('vendor.pagination.fw-admin') }}
        </div>
    </div>
@endif
