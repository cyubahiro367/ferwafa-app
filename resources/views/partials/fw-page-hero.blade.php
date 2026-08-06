@php
    $label = $label ?? 'FERWAFA';
    $title = $title ?? '';
    $crumb = $crumb ?? null;
@endphp
<section class="fw-page-hero">
    <div class="fw-wrap">
        <div class="fw-section-label">{{ $label }}</div>
        <h1 class="fw-page-hero-title">{{ $title }}</h1>
        @if ($crumb)
            <div class="fw-page-hero-crumb">
                <a href="{{ url('/') }}">Home</a>
                <i class="fas fa-chevron-right" style="font-size:9px;opacity:.6"></i>
                @foreach ($crumb as $item)
                    @if (!empty($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        <span>{{ $item['label'] }}</span>
                    @endif
                    @if (!$loop->last)
                        <i class="fas fa-chevron-right" style="font-size:9px;opacity:.6"></i>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>
