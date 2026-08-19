@extends('layouts.public')

@section('title', 'Verify Email – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Verify Email',
    'crumb' => [
        ['label' => 'Verify Email'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Verify Your Email</h2>
            <p class="fw-auth-sub">Check your inbox for a verification link before continuing.</p>

            @if (session('resent'))
                <div class="fw-alert fw-alert-success">A fresh verification link has been sent to your email address.</div>
            @endif

            <p style="font-size:14px;color:var(--text);margin-bottom:20px;">
                If you did not receive the email, you can request another link.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}" class="fw-form" style="max-width:none;">
                @csrf
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Resend Verification Email</button>
            </form>
        </div>
    </div>
</section>
@endsection
