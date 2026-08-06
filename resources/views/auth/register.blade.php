@extends('layouts.public')

@section('title', 'Register – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Register',
    'crumb' => [
        ['label' => 'Register'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Create Account</h2>
            <p class="fw-auth-sub">Complete registration with your invitation details.</p>

            <form method="POST" action="{{ route('register') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="name">Name</label>
                    <input class="fw-form-input" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                    @error('name')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="email">Email</label>
                    <input class="fw-form-input" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly />
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
                <div class="fw-form-group">
                    <label class="fw-form-label" for="key">Invitation Key</label>
                    <input class="fw-form-input" id="key" type="password" name="key" value="{{ $token ?? '' }}" required readonly />
                    @error('key')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Register</button>
            </form>
        </div>
    </div>
</section>
@endsection
