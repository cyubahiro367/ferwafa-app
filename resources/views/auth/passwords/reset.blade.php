@extends('layouts.public')

@section('title', 'Reset Password – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Reset Password',
    'crumb' => [
        ['label' => 'Login', 'url' => route('login')],
        ['label' => 'Reset Password'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Choose a New Password</h2>
            <p class="fw-auth-sub">Enter your email and a new password for your FERWAFA account.</p>

            <form method="POST" action="{{ route('password.update') }}" class="fw-form" style="max-width:none;">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="fw-form-group">
                    <label class="fw-form-label" for="email">Email</label>
                    <input class="fw-form-input" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                    @error('email')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="password">Password</label>
                    <input class="fw-form-input" id="password" type="password" name="password" required autocomplete="new-password" />
                    @error('password')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="password-confirm">Confirm Password</label>
                    <input class="fw-form-input" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Reset Password</button>
                <p style="margin-top:16px;text-align:center;font-size:13px;">
                    <a href="{{ route('login') }}" style="color:var(--blue);">Back to login</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
