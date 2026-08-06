@extends('layouts.public')

@section('title', 'Contact – FERWAFA')
@section('active', 'contact')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Get in Touch',
    'title' => 'Information',
    'crumb' => [
        ['label' => 'Contact'],
        ['label' => 'Information'],
    ],
])

<section class="fw-section">
    <div class="fw-wrap">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;" class="fw-contact-grid">
            <div>
                <div class="fw-section-label">Reach Us</div>
                <h2 class="fw-section-title" style="margin-bottom:24px;">Contact Details</h2>
                <div class="fw-footer-contact" style="gap:20px;">
                    <div class="fw-footer-contact-item" style="color:var(--text);">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Remera, next to Amahoro Stadium<br>PO. Box 2000, Kigali, Rwanda</span>
                    </div>
                    <div class="fw-footer-contact-item" style="color:var(--text);">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <a href="mailto:ferwafa.info@ferwafa.rw" style="color:var(--blue);">ferwafa.info@ferwafa.rw</a><br>
                            <a href="mailto:sgoffice@ferwafa.com" style="color:var(--blue);">sgoffice@ferwafa.com</a>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="fw-section-label">Message</div>
                <h2 class="fw-section-title" style="margin-bottom:24px;">Leave a Message</h2>

                @if (session('error'))
                    <div class="fw-alert fw-alert-error">{{ session('error') }}</div>
                @endif
                @if (session('message'))
                    <div class="fw-alert fw-alert-success">{{ session('message') }}</div>
                @endif

                <form method="POST" action="{{ route('post.send.info') }}" class="fw-form">
                    @csrf
                    <div class="fw-form-group">
                        <label class="fw-form-label" for="name">Your Name</label>
                        <input class="fw-form-input" type="text" name="name" id="name" value="{{ old('name') }}" required />
                        @error('name')<div class="fw-form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="fw-form-group">
                        <label class="fw-form-label" for="email">Email</label>
                        <input class="fw-form-input" type="email" name="email" id="email" value="{{ old('email') }}" required />
                        @error('email')<div class="fw-form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="fw-form-group">
                        <label class="fw-form-label" for="subject">Subject</label>
                        <input class="fw-form-input" type="text" name="subject" id="subject" value="{{ old('subject') }}" required />
                        @error('subject')<div class="fw-form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="fw-form-group">
                        <label class="fw-form-label" for="content">Message</label>
                        <textarea class="fw-form-textarea" name="content" id="content" required>{{ old('content') }}</textarea>
                        @error('content')<div class="fw-form-error">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="fw-btn-gold">Send Message <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
@media (max-width: 768px) {
  .fw-contact-grid { grid-template-columns: 1fr !important; gap: 32px !important; }
}
</style>
@endpush
@endsection
