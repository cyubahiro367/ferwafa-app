@extends('layouts.public')

@section('title', ($result->title ?? 'News') . ' – FERWAFA')
@section('active', 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'News',
    'title' => 'Article',
    'crumb' => [
        ['label' => 'News', 'url' => route('all.news')],
        ['label' => Str::limit($result->title ?? 'Article', 40)],
    ],
])

<section class="fw-section">
    <div class="fw-wrap">
        <article class="fw-article">
            @if (!empty($url) && isset($url[0]))
                <div class="fw-article-img">
                    <img src="{{ route('news.images.show', $url[0]['id']) }}" alt="{{ $result->title }}" />
                </div>
            @endif
            <div class="fw-article-meta">
                <span><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($result->created_at)) }}</span>
            </div>
            <h1 class="fw-article-title">{{ $result->title }}</h1>
            @if ($result->caption)
                <p class="fw-article-caption">{{ $result->caption }}</p>
            @endif
            <div class="fw-article-body">
                {!! nl2br(e($result->description)) !!}
            </div>
            <div style="margin-top:36px;">
                <a href="{{ route('all.news') }}" class="fw-btn-outline"><i class="fas fa-arrow-left"></i> Back to News</a>
            </div>
        </article>
    </div>
</section>
@endsection
