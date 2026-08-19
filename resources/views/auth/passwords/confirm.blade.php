@extends('layouts.public')

@section('title', 'Confirm Password – FERWAFA')
@section('active', '')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Account',
    'title' => 'Confirm Password',
    'crumb' => [
        ['label' => 'Confirm Password'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div class="fw-auth-panel">
            <h2>Confirm Password</h2>
            <p class="fw-auth-sub">Please confirm your password before continuing.</p>

            <form method="POST" action="{{ route('password.confirm') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="password">Password</label>
                    <input class="fw-form-input" id="password" type="password" name="password" required autocomplete="current-password" />
                    @error('password')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="fw-btn-gold" style="width:100%;justify-content:center;">Confirm Password</button>
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
