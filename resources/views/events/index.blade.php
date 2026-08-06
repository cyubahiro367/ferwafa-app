@extends('layouts.public')

@section('title', 'Events – FERWAFA')
@section('active', 'resources')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Resources',
    'title' => 'Events',
    'crumb' => [
        ['label' => 'Events'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        @if ($result->count())
            <div class="fw-news-grid">
                @foreach ($result as $event)
                    <a href="{{ route('single.event', $event->id) }}" class="fw-news-card">
                        <div class="fw-news-card-img">
                            <img src="{{ route('events.images.show', $event->image_id) }}" alt="{{ $event->name }}" loading="lazy" />
                            <span class="fw-news-card-cat">Event</span>
                        </div>
                        <div class="fw-news-card-body">
                            <div class="fw-news-card-meta">
                                <i class="far fa-calendar"></i>
                                {{ date('jS M Y', strtotime($event->created_at)) }}
                            </div>
                            <h3 class="fw-news-card-title">{{ $event->name }}</h3>
                            <p class="fw-news-card-excerpt">{{ Str::limit(strip_tags($event->description), 120) }}</p>
                            <span class="fw-news-card-link">View Event <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                @endforeach
            </div>
            @include('partials.fw-pagination', ['paginator' => $result])
        @else
            <div class="fw-empty">
                <i class="far fa-calendar-alt"></i>
                <p>No events available yet.</p>
            </div>
        @endif
    </div>
</section>
@endsection
