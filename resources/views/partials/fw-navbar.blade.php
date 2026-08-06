@php
    $active = $active ?? '';
    $competions = DB::table('TeamCategory')->select('id', 'name')->get();
    $divisions = DB::table('Division')->select('id', 'name')->get();
    $season = DB::table('Season')->select('id')->orderBy('created_at', 'DESC')->first();

    $menCatId = $competions[0]->id ?? null;
    $womenCatId = $competions[1]->id ?? null;
    $div1Id = $divisions[0]->id ?? null;
    $div2Id = $divisions[1]->id ?? null;
    $seasonId = $season->id ?? 1;

    $menDay = null;
    $womenDay = null;
    if ($menCatId) {
        $menDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->where('Game.isPlayed', 1)
            ->where('Team.categoryID', $menCatId)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
    }
    if ($womenCatId) {
        $womenDay = DB::table('Game')
            ->join('Day', 'Day.id', '=', 'Game.dayID')
            ->join('Team', 'Team.id', '=', 'homeTeamID')
            ->where('Game.isPlayed', 1)
            ->where('Team.categoryID', $womenCatId)
            ->orderBy('Day.id', 'DESC')
            ->first(['Game.dayID']);
    }

    $groups = DB::table('Group')->select('id', 'name')->get();

    $womenFixturesUrl = ($womenCatId && $div1Id)
        ? route('fixtures.show', [$seasonId, $div1Id, $womenCatId, $womenDay->dayID ?? 1])
        : '#';
    $menFixturesUrl = ($menCatId && $div1Id)
        ? route('fixtures.show', [$seasonId, $div1Id, $menCatId, $menDay->dayID ?? 1])
        : '#';
    $menStandingsUrl = ($menCatId && $div1Id)
        ? route('men.first-division-table', [$seasonId, $div1Id, $menCatId])
        : '#';
@endphp

<nav class="fw-navbar">
    <div class="fw-wrap">
        <div class="fw-navbar-inner">
            <a href="{{ url('/') }}" class="fw-nav-logo">
                <div class="fw-nav-logo-img">
                    <img src="{{ asset('images/file.png') }}" alt="FERWAFA" />
                </div>
                <div>
                    <div class="fw-nav-logo-title">FERWAFA</div>
                    <div class="fw-nav-logo-sub">Rwanda Football Federation</div>
                </div>
            </a>

            <div style="display:flex;justify-content:center;">
                <ul class="fw-nav-links">
                    <li><a href="{{ url('/') }}" class="{{ $active === 'home' ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ $active === 'about' ? 'active' : '' }}">About Us</a></li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'women' ? 'active' : '' }}">Women Football <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop">
                                <a href="{{ $womenFixturesUrl }}">First Division</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ $womenFixturesUrl }}">Fixtures &amp; Results</a></li>
                                </ul>
                            </li>
                            <li class="fw-sub-drop">
                                <a href="#">Second Division</a>
                                <ul class="fw-sub-drop-menu">
                                    @foreach ($groups as $group)
                                        <li>
                                            <a href="{{ ($womenCatId && $div2Id) ? route('fixtures.show', [$seasonId, $div2Id, $womenCatId, $womenDay->dayID ?? 1, $group->id]) : '#' }}">
                                                {{ $group->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="fw-sub-drop">
                                <a href="{{ route('seniorWomen.news') }}">National Team</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ route('seniorWomen.news') }}">Senior</a></li>
                                    <li><a href="{{ route('u20Women.news') }}">U-20</a></li>
                                    <li><a href="{{ route('otherWomen.news') }}">Other</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'competitions' ? 'active' : '' }}">Competitions <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop">
                                <a href="{{ $menFixturesUrl }}">Men Football</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ $menFixturesUrl }}">BK Pro League</a></li>
                                    <li><a href="{{ $menStandingsUrl }}">Standings</a></li>
                                    <li class="fw-sub-drop">
                                        <a href="#">Second Division</a>
                                        <ul class="fw-sub-drop-menu">
                                            @foreach ($groups as $group)
                                                <li>
                                                    <a href="{{ ($menCatId && $div2Id) ? route('fixtures.show', [$seasonId, $div2Id, $menCatId, $menDay->dayID ?? 1, $group->id]) : '#' }}">
                                                        {{ $group->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'national' ? 'active' : '' }}">National Teams <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop">
                                <a href="{{ route('seniorMen.news') }}">Men</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ route('seniorMen.news') }}">Senior – Amavubi</a></li>
                                    <li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li>
                                    <li><a href="{{ route('u17.news') }}">U-17</a></li>
                                    <li><a href="{{ route('otherMen.news') }}">Other</a></li>
                                </ul>
                            </li>
                            <li class="fw-sub-drop">
                                <a href="{{ route('seniorWomen.news') }}">Women</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ route('seniorWomen.news') }}">Senior Women</a></li>
                                    <li><a href="{{ route('u20Women.news') }}">U-20 Women</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'resources' ? 'active' : '' }}">Resources <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('report') }}">Report</a></li>
                            <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                            <li><a href="{{ route('laws.page.show') }}">Laws of the Game</a></li>
                            <li><a href="{{ route('rules.page.show') }}">Rules &amp; Regulations</a></li>
                            <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                            <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                            <li><a href="{{ route('all.events') }}">Events</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'development' ? 'active' : '' }}">Development <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                            <li><a href="{{ route('schools.news') }}">Football for Schools</a></li>
                            <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'career' ? 'active' : '' }}">Career <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                            <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                            <li><a href="{{ route('career.page.show') }}">Others</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'bodies' ? 'active' : '' }}">Independent Bodies <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li class="fw-sub-drop">
                                <a href="{{ route('independent-bodies', 1) }}">Judicial Bodies</a>
                                <ul class="fw-sub-drop-menu">
                                    <li><a href="{{ route('independent-bodies', 1) }}">Conflicts Resolution</a></li>
                                    <li><a href="{{ route('independent-bodies', 2) }}">Player Status</a></li>
                                    <li><a href="{{ route('independent-bodies', 3) }}">Ethics Committee</a></li>
                                    <li><a href="{{ route('independent-bodies', 4) }}">Disciplinary</a></li>
                                    <li><a href="{{ route('independent-bodies', 5) }}">Appeal Committee</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('independent-bodies', 6) }}">Audit Committee</a></li>
                            <li><a href="{{ route('independent-bodies', 7) }}">Electoral Committee</a></li>
                            <li><a href="{{ route('independent-bodies', 8) }}">Appeal Electoral</a></li>
                            <li><a href="{{ route('independent-bodies', 9) }}">Club Licensing FBI</a></li>
                            <li><a href="{{ route('independent-bodies', 10) }}">Club Licensing SIB</a></li>
                        </ul>
                    </li>
                    <li class="fw-dropdown">
                        <a href="#" class="{{ $active === 'contact' ? 'active' : '' }}">Contact <i class="fas fa-chevron-down"></i></a>
                        <ul class="fw-dropdown-menu">
                            <li><a href="{{ route('information') }}">Information</a></li>
                            <li><a href="{{ route('whistleblowers') }}">Whistleblowers</a></li>
                        </ul>
                    </li>
                    @if (!Auth::check())
                        <li><a href="{{ route('login') }}" class="fw-nav-cta">Login</a></li>
                    @endif
                </ul>
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button class="fw-hamburger" id="fwHamburger" type="button" aria-label="Open menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="fw-mobile-nav" id="fwMobileNav">
    <div class="fw-mobile-nav-header">
        <div class="fw-mobile-nav-brand">
            <img src="{{ asset('images/file.png') }}" alt="FERWAFA" />
            <span>FERWAFA</span>
        </div>
        <button class="fw-mobile-close" id="fwMobileClose" type="button" aria-label="Close menu"><i class="fas fa-times"></i></button>
    </div>
    <ul class="fw-mobile-links">
        <li><div class="fw-mob-row"><a href="{{ url('/') }}">Home</a></div></li>
        <li><div class="fw-mob-row"><a href="{{ route('about') }}">About Us</a></div></li>
        <li>
            <div class="fw-mob-row"><a href="#">Women Football</a><button class="fw-mob-toggle" type="button" data-target="mob-women"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-women">
                <li><a href="{{ $womenFixturesUrl }}">First Division</a></li>
                <li>
                    <div class="fw-mob-sub-row"><a href="#">Second Division</a><button class="fw-mob-sub-toggle" type="button" data-target="mob-wdiv2"><i class="fas fa-chevron-down"></i></button></div>
                    <ul class="fw-mob-subsub" id="mob-wdiv2">
                        @foreach ($groups as $group)
                            <li>
                                <a href="{{ ($womenCatId && $div2Id) ? route('fixtures.show', [$seasonId, $div2Id, $womenCatId, $womenDay->dayID ?? 1, $group->id]) : '#' }}">
                                    {{ $group->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <div class="fw-mob-sub-row"><a href="{{ route('seniorWomen.news') }}">National Team</a><button class="fw-mob-sub-toggle" type="button" data-target="mob-wnat"><i class="fas fa-chevron-down"></i></button></div>
                    <ul class="fw-mob-subsub" id="mob-wnat">
                        <li><a href="{{ route('seniorWomen.news') }}">Senior</a></li>
                        <li><a href="{{ route('u20Women.news') }}">U-20</a></li>
                        <li><a href="{{ route('otherWomen.news') }}">Other</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Competitions</a><button class="fw-mob-toggle" type="button" data-target="mob-comp"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-comp">
                <li><a href="{{ $menFixturesUrl }}">BK Pro League</a></li>
                <li><a href="{{ $menStandingsUrl }}">Standings</a></li>
                <li>
                    <div class="fw-mob-sub-row"><a href="#">Second Division</a><button class="fw-mob-sub-toggle" type="button" data-target="mob-mdiv2"><i class="fas fa-chevron-down"></i></button></div>
                    <ul class="fw-mob-subsub" id="mob-mdiv2">
                        @foreach ($groups as $group)
                            <li>
                                <a href="{{ ($menCatId && $div2Id) ? route('fixtures.show', [$seasonId, $div2Id, $menCatId, $menDay->dayID ?? 1, $group->id]) : '#' }}">
                                    {{ $group->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">National Teams</a><button class="fw-mob-toggle" type="button" data-target="mob-nat"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-nat">
                <li>
                    <div class="fw-mob-sub-row"><a href="{{ route('seniorMen.news') }}">Men</a><button class="fw-mob-sub-toggle" type="button" data-target="mob-nmen"><i class="fas fa-chevron-down"></i></button></div>
                    <ul class="fw-mob-subsub" id="mob-nmen">
                        <li><a href="{{ route('seniorMen.news') }}">Senior – Amavubi</a></li>
                        <li><a href="{{ route('u23.news') }}">U-23 Olympic</a></li>
                        <li><a href="{{ route('u17.news') }}">U-17</a></li>
                        <li><a href="{{ route('otherMen.news') }}">Other</a></li>
                    </ul>
                </li>
                <li>
                    <div class="fw-mob-sub-row"><a href="{{ route('seniorWomen.news') }}">Women</a><button class="fw-mob-sub-toggle" type="button" data-target="mob-nwom"><i class="fas fa-chevron-down"></i></button></div>
                    <ul class="fw-mob-subsub" id="mob-nwom">
                        <li><a href="{{ route('seniorWomen.news') }}">Senior Women</a></li>
                        <li><a href="{{ route('u20Women.news') }}">U-20 Women</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Resources</a><button class="fw-mob-toggle" type="button" data-target="mob-res"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-res">
                <li><a href="{{ route('report') }}">Report</a></li>
                <li><a href="{{ route('document.page.show') }}">Documents</a></li>
                <li><a href="{{ route('laws.page.show') }}">Laws of the Game</a></li>
                <li><a href="{{ route('rules.page.show') }}">Rules &amp; Regulations</a></li>
                <li><a href="{{ route('circular.page.show') }}">Circular</a></li>
                <li><a href="{{ route('gallery.images') }}">Gallery</a></li>
                <li><a href="{{ route('all.events') }}">Events</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Development</a><button class="fw-mob-toggle" type="button" data-target="mob-dev"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-dev">
                <li><a href="{{ route('grassroots.news') }}">Grassroots Football</a></li>
                <li><a href="{{ route('schools.news') }}">Football for Schools</a></li>
                <li><a href="{{ route('youth.news') }}">Youth Development</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Career</a><button class="fw-mob-toggle" type="button" data-target="mob-car"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-car">
                <li><a href="{{ route('jobs.page.show') }}">Jobs</a></li>
                <li><a href="{{ route('tender.page.show') }}">Tenders</a></li>
                <li><a href="{{ route('career.page.show') }}">Others</a></li>
            </ul>
        </li>
        <li>
            <div class="fw-mob-row"><a href="#">Independent Bodies</a><button class="fw-mob-toggle" type="button" data-target="mob-bodies"><i class="fas fa-chevron-down"></i></button></div>
            <ul class="fw-mob-sub" id="mob-bodies">
                <li><a href="{{ route('independent-bodies', 1) }}">Conflicts Resolution</a></li>
                <li><a href="{{ route('independent-bodies', 6) }}">Audit Committee</a></li>
                <li><a href="{{ route('independent-bodies', 7) }}">Electoral Committee</a></li>
            </ul>
        </li>
        <li><div class="fw-mob-row"><a href="{{ route('information') }}" style="color:var(--gold);">Contact Us</a></div></li>
        @if (!Auth::check())
            <li><div class="fw-mob-row"><a href="{{ route('login') }}">Login</a></div></li>
        @endif
    </ul>
</div>
