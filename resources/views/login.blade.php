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

            @if (Session::get('success'))
                <div class="fw-alert fw-alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::get('fail'))
                <div class="fw-alert fw-alert-error">{{ Session::get('fail') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="email">Email</label>
                    <input class="fw-form-input" id="email" type="email" name="email" value="{{ old('email') }}" required />
                    @error('email')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="password">Password</label>
                    <input class="fw-form-input" id="password" type="password" name="password" required />
                    @error('password')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button name="login" type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Login</button>
            </form>
        </div>
    </div>
</section>
@endsection
