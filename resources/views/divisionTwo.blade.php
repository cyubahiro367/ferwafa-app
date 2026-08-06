@extends('layouts.public')

@section('title', 'Division Groups – FERWAFA')
@section('active', 'competitions')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Competitions',
    'title' => 'Select Group',
    'crumb' => [
        ['label' => 'Competitions'],
        ['label' => 'Groups'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-section-label">Groups</div>
        <h2 class="fw-section-title" style="margin-bottom:28px;">Choose a Group</h2>

        @if (count($groups))
            <div class="fw-group-cards">
                @foreach ($groups as $group)
                    <a class="fw-group-card" href="{{ route('fixtures.show', [$seasonID, request()->route('divisionID'), request()->route('categoryID'), $dayID, $group->id]) }}">
                        <h3>{{ $group->name }}</h3>
                        <p>View fixtures &amp; results</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="fw-empty">
                <i class="fas fa-layer-group"></i>
                <p>No groups available for this division.</p>
            </div>
        @endif
    </div>
</section>
@endsection
