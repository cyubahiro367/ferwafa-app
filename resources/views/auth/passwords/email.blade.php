@extends('layouts.public')

@section('title', 'Forgot Password – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Forgot Password',
    'crumb' => [
        ['label' => 'Login', 'url' => route('login')],
        ['label' => 'Forgot Password'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Reset Password</h2>
            <p class="fw-auth-sub">Enter your email and we will send you a reset link.</p>

            @if (session('status'))
                <div class="fw-alert fw-alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="email">Email</label>
                    <input class="fw-form-input" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Send Reset Link</button>
                <p style="margin-top:16px;text-align:center;font-size:13px;">
                    <a href="{{ route('login') }}" style="color:var(--blue);">Back to login</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
