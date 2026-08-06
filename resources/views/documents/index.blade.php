@extends('layouts.public')

@section('title', $pageTitle . ' – FERWAFA')
@section('active', $navActive ?? 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => $pageLabel ?? 'Resources',
    'title' => $pageTitle,
    'crumb' => [
        ['label' => $pageTitle],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        @if ($documents->count())
            <div class="fw-doc-list">
                @foreach ($documents as $doc)
                    <a href="{{ route('report.doc', $doc->id) }}" class="fw-doc-row" target="_blank" rel="noopener">
                        <div class="fw-doc-row-left">
                            <div class="fw-doc-icon"><i class="fas fa-file-pdf"></i></div>
                            <div>
                                <div class="fw-doc-title">{{ $doc->title }}</div>
                                <div class="fw-doc-meta">
                                    <i class="far fa-calendar"></i>
                                    {{ date('jS M Y', strtotime($doc->created_at)) }}
                                </div>
                            </div>
                        </div>
                        <span class="fw-doc-dl">Download <i class="fas fa-download"></i></span>
                    </a>
                @endforeach
            </div>
            @include('partials.fw-pagination', ['paginator' => $documents])
        @else
            <div class="fw-empty">
                <i class="far fa-folder-open"></i>
                <p>No documents available yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
