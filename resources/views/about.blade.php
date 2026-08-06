@extends('layouts.public')

@section('title', 'About Us – FERWAFA')
@section('active', 'about')

@section('content')
@include('partials.fw-page-hero', [
    'label' => 'FERWAFA',
    'title' => 'About Us',
    'crumb' => [
        ['label' => 'About Us'],
    ],
])

<section class="fw-section">
    <div class="fw-wrap">
        <div class="fw-tabs" id="fwAboutTabs">
            <button type="button" class="fw-tab active" data-panel="about-who">Who We Are</button>
            <button type="button" class="fw-tab" data-panel="about-mission">Our Mission</button>
            <button type="button" class="fw-tab" data-panel="about-vision">Our Vision</button>
            <button type="button" class="fw-tab" data-panel="about-history">History</button>
        </div>

        <div class="fw-tab-panel active" id="about-who">
            <div class="fw-section-label">Identity</div>
            <h2 class="fw-section-title" style="margin-bottom:20px;">Who We Are</h2>
            <div class="fw-prose">
                <p>
                    The Federation Rwandaise of Football Association – FERWAFA –
                    a non-governmental and non-profit organization has the
                    national mandate to develop and organize football
                    competitions throughout Rwanda.
                </p>
                <p>
                    It is the sole institution governing football in Rwanda
                    and recognized as such by the Government of Rwanda on one
                    hand and by both FIFA and CAF as their member on the other hand.
                </p>
            </div>
        </div>

        <div class="fw-tab-panel" id="about-mission">
            <div class="fw-section-label">Purpose</div>
            <h2 class="fw-section-title" style="margin-bottom:20px;">Our Mission</h2>
            <div class="fw-prose">
                <ul>
                    <li>To develop and improve the football game throughout Rwanda and improve the country FIFA/CAF ranking.</li>
                    <li>To contribute to physical and moral self-fulfillment of the population in general and the Youth in particular through football.</li>
                    <li>To organize friendly games and competitions through football associations for all age categories including women, veterans, and students.</li>
                    <li>To promote integrity, fair play, and excellence in Rwanda football.</li>
                </ul>
            </div>
        </div>

        <div class="fw-tab-panel" id="about-vision">
            <div class="fw-section-label">Ambition</div>
            <h2 class="fw-section-title" style="margin-bottom:20px;">Our Vision</h2>
            <div class="fw-prose">
                <p>
                    To be a leading football federation in Africa, recognized for developing
                    world-class talent, organizing competitive leagues, and uniting communities
                    through the beautiful game — guided by Unity, Discipline, and Victory.
                </p>
            </div>
        </div>

        <div class="fw-tab-panel" id="about-history">
            <div class="fw-section-label">Legacy</div>
            <h2 class="fw-section-title" style="margin-bottom:20px;">Our History</h2>
            <div class="fw-prose">
                <p>
                    FERWAFA was established in 1972 and became affiliated with CAF and FIFA in 1978.
                    Since then, the federation has grown football across Rwanda — from grassroots
                    programs to professional leagues and national team competitions on the continental stage.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="fw-section fw-teams-section">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div>
                <div class="fw-section-label">Leadership</div>
                <h2 class="fw-section-title">Executive Committee</h2>
            </div>
        </div>

        @if ($committe->count())
            <div class="fw-member-grid">
                @foreach ($committe as $value)
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
            @include('partials.fw-pagination', ['paginator' => $committe])
        @else
            <div class="fw-empty">
                <i class="far fa-user"></i>
                <p>Committee members will appear here.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('#fwAboutTabs .fw-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('#fwAboutTabs .fw-tab').forEach(function (t) { t.classList.remove('active'); });
            document.querySelectorAll('.fw-tab-panel').forEach(function (p) { p.classList.remove('active'); });
            tab.classList.add('active');
            document.getElementById(tab.dataset.panel).classList.add('active');
        });
    });
</script>
@endpush
