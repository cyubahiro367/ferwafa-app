@extends('layouts.public')

@section('title', 'Dashboard – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Dashboard',
    'crumb' => [
        ['label' => 'Dashboard'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>You are logged in</h2>
            <p class="fw-auth-sub">Your FERWAFA account is active.</p>

            @if (session('status'))
                <div class="fw-alert fw-alert-success">{{ session('status') }}</div>
            @endif

            <p style="margin-top:8px;text-align:center;font-size:13px;">
                <a href="{{ url('/') }}" style="color:var(--blue);">Back to home</a>
            </p>
        </div>
    </div>
</section>
@endsection
