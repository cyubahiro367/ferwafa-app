@extends('layouts.public')

@section('title', ($title ?? 'Independent Bodies') . ' – FERWAFA')
@section('active', 'bodies')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'Independent Bodies',
    'title' => $title,
    'crumb' => [
        ['label' => 'Independent Bodies'],
        ['label' => $title],
    ],
])

<section class="fw-section">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div>
                <div class="fw-section-label">Members</div>
                <h2 class="fw-section-title">{{ $title }}</h2>
            </div>
        </div>

        @if ($committee->count())
            <div class="fw-member-grid">
                @foreach ($committee as $value)
                    <div class="fw-member-card">
                        <div class="fw-member-photo">
                            @if ($value->url)
                                <img src="{{ route('comitte.doc', $value->id) }}" alt="{{ $value->name }}" loading="lazy" />
                            @else
                                <img src="{{ asset('images/file.png') }}" alt="{{ $value->name }}" loading="lazy" />
                            @endif
                        </div>
                        <div class="fw-member-body">
                            <div class="fw-member-name">{{ $value->name }}</div>
                            <div class="fw-member-role">{{ $value->position }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('partials.fw-pagination', ['paginator' => $committee])
        @else
            <div class="fw-empty">
                <i class="far fa-user"></i>
                <p>No members listed for this body yet.</p>
            </div>
        @endif
    </div>
</section>

<section class="fw-section" style="background:var(--off-white);">
    <div class="fw-wrap">
        <div style="max-width:720px;margin:0 auto;">
            <div class="fw-section-label">Submit</div>
            <h2 class="fw-section-title" style="margin-bottom:24px;">Brief / Case</h2>

            @if (session('error'))
                <div class="fw-alert fw-alert-error">{{ session('error') }}</div>
            @endif
            @if (session('mesage') || session('message'))
                <div class="fw-alert fw-alert-success">{{ session('mesage') ?? session('message') }}</div>
            @endif

            <form method="POST" action="{{ route('independent.message') }}" enctype="multipart/form-data" class="fw-form" style="max-width:none;">
                @csrf
                <input type="hidden" name="committeeCategoryID" value="{{ $committeeCategoryID }}" />

                <div class="fw-form-group">
                    <label class="fw-form-label" for="name">Your Name</label>
                    <input class="fw-form-input" type="text" name="name" id="name" value="{{ old('name') }}" required />
                    @error('name')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="phone">Phone</label>
                    <input class="fw-form-input" type="text" name="phone" id="phone" value="{{ old('phone') }}" required />
                    @error('phone')<div class="fw-form-error">{{ $message }}</div>@enderror
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
                    <label class="fw-form-label" for="message">Message</label>
                    <textarea class="fw-form-textarea" name="message" id="message" required>{{ old('message') }}</textarea>
                    @error('message')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <div class="fw-form-group">
                    <label class="fw-form-label" for="reportFile">Attachment (PDF)</label>
                    <input class="fw-form-input" type="file" name="reportFile" id="reportFile" accept=".pdf" required />
                    @error('reportFile')<div class="fw-form-error">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="fw-btn-gold">Submit Case <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>
@endsection
