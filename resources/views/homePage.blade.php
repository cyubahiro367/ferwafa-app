@extends('layouts.public')

@section('title', 'FERWAFA – Rwanda Football Federation')
@section('active', 'home')

@section('content')
{{-- HERO SLIDER --}}
<section class="fw-hero">
    <div class="fw-hero-slides" id="fwSlides">
        @php $si = 0; @endphp
        @foreach ($topResults as $topResult)
            @if ($topResult['is_top'] == 1)
                <div class="fw-hero-slide {{ $si === 0 ? 'active' : '' }}">
                    <div class="fw-hero-bg" style="background-image:url('{{ route('news.images.show', $topResult['image_id']) }}')"></div>
                    <div class="fw-wrap fw-hero-content">
                        <div class="fw-hero-inner">
                            <div class="fw-hero-tag"><i class="fas fa-futbol"></i> Featured</div>
                            <h1 class="fw-hero-title">{{ $topResult['title'] }}</h1>
                            <p class="fw-hero-sub">{{ Str::limit($topResult['caption'], 150) }}</p>
                            <div class="fw-hero-actions" style="margin-bottom:20px">
                                <a href="{{ route('single.news', $topResult['id']) }}" class="fw-btn-gold"><i class="fas fa-arrow-right"></i> Read More</a>
                                <a href="{{ route('all.news') }}" class="fw-btn-ghost"><i class="fas fa-newspaper"></i> All News</a>
                            </div>
                        </div>
                    </div>
                </div>
                @php $si++; @endphp
            @endif
        @endforeach
    </div>

    <div class="fw-hero-controls" id="fwControls">
        <button class="fw-hero-prev" id="fwPrev" type="button"><i class="fas fa-chevron-left"></i></button>
        <div class="fw-hero-dots" id="fwDots">
            @php $di = 0; @endphp
            @foreach ($topResults as $topResult)
                @if ($topResult['is_top'] == 1)
                    <div class="fw-hero-dot {{ $di === 0 ? 'active' : '' }}" data-index="{{ $di }}"></div>
                    @php $di++; @endphp
                @endif
            @endforeach
        </div>
        <button class="fw-hero-next" id="fwNext" type="button"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

{{-- TICKER --}}
<div class="fw-ticker">
    <div class="fw-ticker-label"><i class="fas fa-bolt"></i> Latest</div>
    <div class="fw-ticker-track">
        <div class="fw-ticker-inner">
            @foreach ($result as $news)<span class="fw-ticker-item">{{ $news['title'] }}</span>@endforeach
            @foreach ($result as $news)<span class="fw-ticker-item">{{ $news['title'] }}</span>@endforeach
        </div>
    </div>
</div>

{{-- LATEST NEWS --}}
<div class="fw-section" style="background:#fff;">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div>
                <div class="fw-section-label">Recent Updates</div>
                <h2 class="fw-section-title">Latest News</h2>
            </div>
            <a href="{{ route('all.news') }}" class="fw-view-all">All News <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="fw-news-layout">
            @if (isset($result[0]))
                <div class="fw-news-featured">
                    <a href="{{ route('single.news', $result[0]['id']) }}" class="fw-news-card">
                        <div class="fw-news-card-img">
                            <img src="{{ route('news.images.show', $result[0]['image_id']) }}" alt="{{ $result[0]['title'] }}" loading="lazy" />
                            <span class="fw-news-card-cat">News</span>
                        </div>
                        <div class="fw-news-card-body">
                            <div class="fw-news-card-meta"><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($result[0]['created_at'])) }}</div>
                            <h3 class="fw-news-card-title">{{ $result[0]['title'] }}</h3>
                            <p class="fw-news-card-excerpt">{{ $result[0]['caption'] }}</p>
                            <span class="fw-news-card-link">Read Full Story <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <div class="fw-news-right">
                @foreach ($result as $index => $news)
                    @if ($index > 0 && $index <= 4)
                        <a href="{{ route('single.news', $news['id']) }}" class="fw-news-list-item">
                            <div class="fw-news-list-img"><img src="{{ route('news.images.show', $news['image_id']) }}" alt="{{ $news['title'] }}" loading="lazy" /></div>
                            <div class="fw-news-list-body">
                                <div class="fw-news-list-meta"><i class="far fa-calendar"></i> {{ date('jS M Y', strtotime($news['created_at'])) }}</div>
                                <h4 class="fw-news-list-title">{{ $news['title'] }}</h4>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- COMPETITIONS --}}
<section class="fw-comp-bar">
    <div class="fw-wrap">
        <div class="fw-section-label" style="color:var(--gold);">Rwanda Football</div>
        <h2 class="fw-section-title" style="color:#fff;">Competitions</h2>
        <div class="fw-comp-grid">
            <a href="{{ route('all.news') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-shield-halved"></i></div><div><div class="fw-comp-name">BK Pro League</div><div class="fw-comp-meta">Men · First Division</div></div></a>
            <a href="{{ route('seniorWomen.news') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-venus"></i></div><div><div class="fw-comp-name">Women Super League</div><div class="fw-comp-meta">Women · First Division</div></div></a>
            <a href="{{ route('youth.news') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-seedling"></i></div><div><div class="fw-comp-name">Youth Leagues</div><div class="fw-comp-meta">U-17 · U-20 · U-23</div></div></a>
            <a href="{{ route('all.events') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-trophy"></i></div><div><div class="fw-comp-name">Events</div><div class="fw-comp-meta">Fixtures &amp; Cups</div></div></a>
            <a href="{{ route('gallery.images') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-camera"></i></div><div><div class="fw-comp-name">Gallery</div><div class="fw-comp-meta">Photos</div></div></a>
            <a href="{{ route('document.page.show') }}" class="fw-comp-card"><div class="fw-comp-icon"><i class="fas fa-file-lines"></i></div><div><div class="fw-comp-name">Documents</div><div class="fw-comp-meta">Official resources</div></div></a>
        </div>
    </div>
</section>

{{-- NATIONAL TEAMS --}}
<section class="fw-section fw-teams-section">
    <div class="fw-wrap">
        <div class="fw-section-head">
            <div><div class="fw-section-label">Rwanda's Pride</div><h2 class="fw-section-title">National Teams</h2></div>
            <a href="{{ route('seniorMen.news') }}" class="fw-view-all">All Teams <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="fw-teams-grid">
            <a href="{{ route('seniorMen.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">AMAVUBI<br>STARS</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Senior Men – Amavubi</div><div class="fw-team-desc">Rwanda's senior men's team competing in AFCON qualifiers and CAF competitions.</div><span class="fw-team-link">View Team <i class="fas fa-arrow-right"></i></span></div>
            </a>
            <a href="{{ route('seniorWomen.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">SENIOR<br>WOMEN</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Senior Women</div><div class="fw-team-desc">Rwanda's senior women's team competing in WAFCON qualifiers and growing the women's game.</div><span class="fw-team-link">View Team <i class="fas fa-arrow-right"></i></span></div>
            </a>
            <a href="{{ route('u17.news') }}" class="fw-team-card">
                <div class="fw-team-card-header"><div class="fw-team-badge">YOUTH<br>TEAMS</div><div class="fw-team-flag"><span style="background:#00A1DE;"></span><span style="background:#FAD201;"></span><span style="background:#20603D;"></span></div></div>
                <div class="fw-team-card-body"><div class="fw-team-name">Youth Teams</div><div class="fw-team-desc">U-17, U-20 &amp; U-23 squads representing Rwanda's next generation of football talent.</div><span class="fw-team-link">View Teams <i class="fas fa-arrow-right"></i></span></div>
            </a>
        </div>
    </div>
</section>

{{-- PARTNERS --}}
<div class="fw-partners">
    <div class="fw-wrap">
        <p class="fw-partners-label">Our Partners &amp; Affiliates</p>
        <div class="fw-partners-row">
            <a href="https://www.minisports.gov.rw/" target="_blank" rel="noopener" class="fw-partner-logo"><img src="{{ asset('images/images.jpeg') }}" alt="MINISPORTS" /></a>
            <a href="https://www.cafonline.com/" target="_blank" rel="noopener" class="fw-partner-logo"><img src="{{ asset('images/pngtree-caf-football-logo-png-image_3643068.jpg') }}" alt="CAF" onerror="this.style.display='none'" /></a>
            <a href="https://olympicrwanda.org/" target="_blank" rel="noopener" class="fw-partner-logo"><img src="{{ asset('images/Logo Institu CNOSR sans fond.png') }}" alt="Rwanda Olympics" /></a>
            <a href="https://bralirwa.co.rw/" target="_blank" rel="noopener" class="fw-partner-logo"><img src="{{ asset('images/primus.jpg') }}" alt="Primus" onerror="this.style.display='none'" /></a>
            <a href="https://www.fifa.com/fifaplus/en" target="_blank" rel="noopener" class="fw-partner-logo"><img src="{{ asset('images/fifa.png') }}" alt="FIFA" /></a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var fwSlides  = document.querySelectorAll('.fw-hero-slide');
    var fwDots    = document.querySelectorAll('.fw-hero-dot');
    var fwCurrent = 0, fwTimer;
    function fwGoTo(n) {
        if (!fwSlides.length) return;
        fwSlides[fwCurrent].classList.remove('active');
        if (fwDots[fwCurrent]) fwDots[fwCurrent].classList.remove('active');
        fwCurrent = (n + fwSlides.length) % fwSlides.length;
        fwSlides[fwCurrent].classList.add('active');
        if (fwDots[fwCurrent]) fwDots[fwCurrent].classList.add('active');
    }
    function fwStartAuto() { fwTimer = setInterval(function(){ fwGoTo(fwCurrent + 1); }, 5500); }
    function fwResetAuto()  { clearInterval(fwTimer); fwStartAuto(); }
    var fwPrev = document.getElementById('fwPrev');
    var fwNext = document.getElementById('fwNext');
    if (fwPrev) fwPrev.addEventListener('click', function(){ fwGoTo(fwCurrent - 1); fwResetAuto(); });
    if (fwNext) fwNext.addEventListener('click', function(){ fwGoTo(fwCurrent + 1); fwResetAuto(); });
    fwDots.forEach(function(d){ d.addEventListener('click', function(){ fwGoTo(+d.dataset.index); fwResetAuto(); }); });
    if (fwSlides.length > 1) fwStartAuto();
</script>
@endpush
