@extends('layouts.public')

@section('title', 'Gallery – FERWAFA')
@section('active', 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Resources',
    'title' => 'Gallery',
    'crumb' => [
        ['label' => 'Gallery'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        @if ($galleries->count())
            <div class="fw-gallery-grid">
                @foreach ($galleries as $gallery)
                    <a href="{{ route('gallery.doc', $gallery->id) }}" class="fw-gallery-item" target="_blank" rel="noopener">
                        <img src="{{ route('gallery.doc', $gallery->id) }}" alt="{{ $gallery->name }}" loading="lazy" />
                        <div class="fw-gallery-caption">{{ $gallery->name }}</div>
                    </a>
                @endforeach
            </div>
            @include('partials.fw-pagination', ['paginator' => $galleries])
        @else
            <div class="fw-empty">
                <i class="far fa-images"></i>
                <p>No gallery images available yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
