@extends('layouts.public')

@section('title', 'Login – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Login',
    'crumb' => [
        ['label' => 'Login'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Welcome Back</h2>
            <p class="fw-auth-sub">Sign in to access your FERWAFA account.</p>

            <form method="POST" action="{{ route('login') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="email">Email</label>
                    <input class="fw-form-input" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                    @error('email')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="password">Password</label>
                    <input class="fw-form-input" id="password" type="password" name="password" required autocomplete="current-password" />
                    @error('password')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group" style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label for="remember" style="font-size:14px;color:var(--text);">Remember Me</label>
                </div>
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Login</button>
                @if (Route::has('password.request'))
                    <p style="margin-top:16px;text-align:center;font-size:13px;">
                        <a href="{{ route('password.request') }}" style="color:var(--blue);">Forgot your password?</a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</section>
@endsection
