@if ($paginator instanceof \Illuminate\Contracts\Pagination\Paginator && $paginator->hasPages())
    <div class="fw-pagination">
        {{ $paginator->withQueryString()->links('vendor.pagination.fw') }}
    </div>
@endif
