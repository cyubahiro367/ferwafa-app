@extends('layouts.public')

@section('title', 'Whistleblowers – FERWAFA')
@section('active', 'contact')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Integrity',
    'title' => 'Whistleblowers',
    'crumb' => [
        ['label' => 'Contact'],
        ['label' => 'Whistleblowers'],
    ],
])

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div style="max-width:640px;margin:0 auto;">
            <div class="fw-section-label">Confidential</div>
            <h2 class="fw-section-title" style="margin-bottom:16px;">Report a Concern</h2>
            <p class="fw-prose" style="margin-bottom:28px;">
                Use this channel to securely report misconduct, integrity breaches, or other concerns.
                Your message will be handled confidentially.
            </p>

            @if (session('error'))
                <div class="fw-alert fw-alert-error">{{ session('error') }}</div>
            @endif
            @if (session('message') || session('mesage'))
                <div class="fw-alert fw-alert-success">{{ session('message') ?? session('mesage') }}</div>
            @endif

            <form method="POST" action="{{ route('post.send.whistle') }}" class="fw-form" style="max-width:none;">
                @csrf
                <div class="fw-form-group">
                    <label class="fw-form-label" for="message">Your Report</label>
                    <textarea class="fw-form-textarea" name="message" id="message" style="min-height:200px;" required>{{ old('message') }}</textarea>
                    @error('message')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="fw-btn-gold">Submit Report <i class="fas fa-shield-halved"></i></button>
            </form>
        </div>
    </div>
</section>
@endsection
