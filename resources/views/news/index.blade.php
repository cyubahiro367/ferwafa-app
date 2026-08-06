@extends('layouts.public')

@section('title', $pageTitle . ' – FERWAFA')
@section('active', $navActive ?? 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => $pageLabel ?? 'News',
    'title' => $pageTitle,
    'crumb' => [
        ['label' => $pageTitle],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        @if ($result->count())
            <div class="fw-news-grid">
                @foreach ($result as $news)
                    <a href="{{ route('single.news', $news->id) }}" class="fw-news-card">
                        <div class="fw-news-card-img">
                            <img src="{{ route('news.images.show', $news->image_id) }}" alt="{{ $news->title }}" loading="lazy" />
                            <span class="fw-news-card-cat">News</span>
                        </div>
                        <div class="fw-news-card-body">
                            <div class="fw-news-card-meta">
                                <i class="far fa-calendar"></i>
                                {{ date('jS M Y', strtotime($news->created_at)) }}
                            </div>
                            <h3 class="fw-news-card-title">{{ $news->title }}</h3>
                            <p class="fw-news-card-excerpt">{{ Str::limit($news->caption, 120) }}</p>
                            <span class="fw-news-card-link">Read More <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
            @include('partials.fw-pagination', ['paginator' => $result])
        @else
            <div class="fw-empty">
                <i class="far fa-newspaper"></i>
                <p>No news articles available yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
