@extends('layouts.public')

@section('title', ($result->name ?? 'Event') . ' – FERWAFA')
@section('active', 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Events',
    'title' => 'Event Details',
    'crumb' => [
        ['label' => 'Events', 'url' => route('all.events')],
        ['label' => Str::limit($result->name ?? 'Event', 40)],
    ],
])

<section class="fw-section">
    <div class="fw-wrap">
        <article class="fw-article">
            @if (!empty($url) && isset($url[0]))
                <div class="fw-article-img">
                    <img src="{{ route('events.images.show', $url[0]['id']) }}" alt="{{ $result->name }}" />
                </div>
            @endif
            <div class="fw-article-meta">
                <span><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($result->created_at)) }}</span>
            </div>
            <h1 class="fw-article-title">{{ $result->name }}</h1>
            <div class="fw-article-body">
                {!! nl2br(e($result->description)) !!}
            </div>
            <div style="margin-top:36px;">
                <a href="{{ route('all.events') }}" class="fw-btn-outline"><i class="fas fa-arrow-left"></i> Back to Events</a>
            </div>
        </article>
    </div>
</section>
@endsection
